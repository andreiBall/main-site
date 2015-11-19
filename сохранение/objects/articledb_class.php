<?php
//объект -статьи
class ArticleDB extends ObjectDB {
	
	protected static $table = "articles";//название таблицы в базе данных
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("title", "ValidateTitle");//заголовок
		$this->add("img", "ValidateIMG");//картинка
		$this->add("intro", "ValidateText");//введение
		$this->add("full", "ValidateText");//полный текст
		$this->add("section_id", "ValidateID");//ID секции
		$this->add("cat_id", "ValidateID");//ID категории
		$this->add("date", "ValidateDate", self::TYPE_TIMESTAMP, $this->getDate());//дата
		$this->add("meta_desc", "ValidateMD");//описание в метатегах
		$this->add("meta_key", "ValidateMK");//ключевые слова
	}
	
	/*-обработка события после инициализации-*/
	protected function postInit() {
		if (!is_null($this->img)) $this->img = Config::DIR_IMG_ARTICLES.$this->img;//указание полного пути к картинке по константе
		$this->link = URL::get("article", "", array("id" => $this->id));//ссылка на статью
		return true;
	}
	
	/*-выделение пункта в меню при выборе статьи-*/
	protected function postLoad() {
		$this->postHandling();
		return true;
	}
	
	/*-вывод всех статей на сайте-*/
	//$count кол-во//$offset смещение//post_handling пост обработчик статей (поиск по статьям-кол-ко коментариев и т.д.)//
	public static function getAllShow($count = false, $offset = false, $post_handling = false) {
		$select = self::getBaseSelect();//получени всех полей таблицы
		$select->order("date", false);//сортировка по дате по убыванию
		if ($count) $select->limit($count, $offset);//если указано кол-во статей которые нужно вывести ограничиваем
		$data = self::$db->select($select);
		$articles = ObjectDB::buildMultiple(__CLASS__, $data);
		if ($post_handling) foreach ($articles as $article) $article->postHandling();
		return $articles;
	}
	
	/*-вывод статей пренадлежащих определенному разделу-*/
	//section_id - ID раздела//count - количество выводимых статей// offset - смещение 
	public static function getAllOnPageAndSectionID($section_id, $count, $offset = false) {
		$select = self::getBaseSelect();//получени всех полей таблицы
		$select->order("date", false)//сортировка по дате по убыванию
			->where("`section_id` = ".self::$db->getSQ(), array($section_id))
			->limit($count, $offset);//отработка огран-й по кол-ву статей
		$data = self::$db->select($select);
		$articles = ObjectDB::buildMultiple(__CLASS__, $data);
		foreach ($articles as $article) $article->postHandling();
		return $articles;
	}
	
	/*-все статьи по разделу-*/
	//$section_id - id раздела //order -направление сортировки// offset - смещение (к примеру первые три статьи не учавствуют)
	public static function getAllOnSectionID($section_id, $order = false, $offset = false) {
		return self::getAllOnSectionOrCategory("section_id", $section_id, $order, $offset);
	}
	
	/*-все статьи по категории-*/
	public static function getAllOnCatID($cat_id, $order = false, $offset = false) {
		return self::getAllOnSectionOrCategory("cat_id", $cat_id, $order, $offset);
	}
	
	/*-выборка всех статей с сортировкой и where-*/
	//value -значение в запросе
	private static function getAllOnSectionOrCategory($field, $value, $order, $offset) {
		$select = self::getBaseSelect();//получени всех полей таблицы
		$select->where("`$field` = ".self::$db->getSQ(), array($value))//передаем предикат where
			->order("date", $order);//сортировка направлениее из параметра
		$data = self::$db->select($select);//ош
		$articles = ObjectDB::buildMultiple(__CLASS__, $data);
		return $articles;
	}
	
	/*-данные о предыдущей статье-*/
	public function loadPrevArticle($article_db) {
		$select = self::getBaseNeighbourSelect($article_db);//метод получить соседа
		$select->where("`id` < ".self::$db->getSQ(), array($article_db->id))//условие id должно быт меньше передаваемой статьй
			->order("date", false);//сортируем 
		$row = self::$db->selectRow($select);
		return $this->init($row);
	}
	
	/*-данные о следующей статье-*/
	public function loadNextArticle($article_db) {
		$select = self::getBaseNeighbourSelect($article_db);//метод получить соседа
		$select->where("`id` > ".self::$db->getSQ(), array($article_db->id));//условие id должно быт больше передаваемой статьй
		$row = self::$db->selectRow($select);
		return $this->init($row);
	}
	
	/*-поиск по сайту-*/
	public static function search($words) {
		$select = self::getBaseSelect();
		$articles = self::searchObjects($select, __CLASS__, array("title", "full"), $words, Config::MIN_SEARCH_LEN);
		foreach ($articles as $article) $article->setSectionAndCategory();
		return $articles;
	}
	
	/*-метод получить соседа-*/
	private static function getBaseNeighbourSelect($article_db) {
		$select = self::getBaseSelect();//получени всех полей таблицы
		$select->where("`cat_id` = ".self::$db->getSQ(), array($article_db->cat_id))
			->order("date")
			->limit(1);
		return $select;
	}
	
	/*-получение названия картинки (убирая название пути к ней)-*/
	protected function preValidate() {
		if (!is_null($this->img)) $this->img = basename($this->img);
		return true;
	}
	
	/*-получени всех полей таблицы-*/
	private static function getBaseSelect() {
		$select = new Select(self::$db);
		$select->from(self::$table, "*");
		return $select;
	}
	
	/*-подгружаем разделы и категории-*/
	private function setSectionAndCategory() {
		$section = new SectionDB();
		$section->load($this->section_id);
		$category = new CategoryDB();
		$category->load($this->cat_id);
		if ($section->isSaved()) $this->section = $section;
		if ($category->isSaved()) $this->category = $category;
		
	}
	
	
	/*-Пост обработка(поиск по статьям-кол-ко коментариев и т.д.)-*/
	private function postHandling() {
		$this->setSectionAndCategory();//подгружаем разделы и категории
		$this->count_comments = CommentDB::getCountOnArticleID($this->id);//кол-во коментариев
		$this->day_show = ObjectDB::getDay($this->date);
		$this->month_show = ObjectDB::getMonth($this->date);
		
	}
	
}

?>