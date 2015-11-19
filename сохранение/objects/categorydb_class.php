<?php
//объект отвечающий за категории
class CategoryDB extends ObjectDB {
	
	protected static $table = "categories";//название таблицы в базе данных
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("title", "ValidateTitle");//заголовок
		$this->add("img", "ValidateIMG");//картинка
		$this->add("section_id", "ValidateID");//id секции
		$this->add("description", "ValidateText");//текст
		$this->add("meta_desc", "ValidateMD");//описание в метатегах
		$this->add("meta_key", "ValidateMK");//ключевые слова
	}
	
	/*-обработка события после инициализации-*/
	protected function postInit() {
		if (!is_null($this->img)) $this->img = Config::DIR_IMG_ARTICLES.$this->img;//указание полного пути к картинке по константе
		$this->link = URL::get("category", "", array("id" => $this->id));//ссылка
		$section = new SectionDB();//раздел которому пренадлежит категория
		$section->load($this->section_id);
		$this->section = $section;
		return true;
	}
	
	/*-получение названия картинки (убирая название пути к ней)-*/
	protected function preValidate() {
		if (!is_null($this->img)) $this->img = basename($this->img);
		return true;
	}
	
}

?>