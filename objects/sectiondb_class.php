<?php
//объект - отвечает за разделы
class SectionDB extends ObjectDB {
	
	protected static $table = "sections";//название таблицы в базе данных
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("title", "ValidateTitle");//заголовок
		$this->add("img", "ValidateIMG");//картинка
		$this->add("description", "ValidateText");//текст
		$this->add("meta_desc", "ValidateMD");//описание в метатегах
		$this->add("meta_key", "ValidateMK");//ключевые слова
	}
	
	/*-обработка события после инициализации-*/
	protected function postInit() {
		if (!is_null($this->img)) $this->img = Config::DIR_IMG_ARTICLES.$this->img;//указание полного пути к картинке по константе
		$this->link = URL::get("section", "", array("id" => $this->id));//ссылка на раздел
		return true;
	}
	
	/*-получение названия картинки (убирая название пути к ней)-*/
	protected function preValidate() {
		if (!is_null($this->img)) $this->img = basename($this->img);
		return true;
	}
	
	public function accessEdit($auth_user, $field) {//угроза безопасности
		if ($field == "title") return true;
		return false;
	}
	
	public function accessDelete($auth_user) {//угроза безопасности
		return true;
	}
	
}

?>