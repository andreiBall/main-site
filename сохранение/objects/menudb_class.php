<?php
//объект для работы с меню
class MenuDB extends ObjectDB {
	
	protected static $table = "menu";//название таблицы в базе данных
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("type", "ValidateID");//тип -аналог ID 
		$this->add("title", "ValidateTitle");//заголовок
		$this->add("link", "ValidateURL");//ссылка
		$this->add("parent_id", "ValidateID");//
		$this->add("external", "ValidateBoolean");//
	}
	
	/*-получение атрибутов верхнее меню-*/
	public static function getTopMenu() {
		return ObjectDB::getAllOnField(self::$table, __CLASS__, "type", TOPMENU, "id");
	}
	
	/*-получение атрибутов  нижнего меню-*/
	public static function getMainMenu() {
		return ObjectDB::getAllOnField(self::$table, __CLASS__, "type", MAINMENU, "id");
	}
	
}

?>