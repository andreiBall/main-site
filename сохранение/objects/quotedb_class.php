<?php
//объект для работы с цитатами
class QuoteDB extends ObjectDB {
	
	protected static $table = "quotes";//название таблицы в базе данных
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("author", "ValidateTitle");//автор
		$this->add("text", "ValidateSmallText");//текст
	}
	
	public function loadRandom() {//загрузка случайной цитаты
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->rand()
			->limit(1);
		$row = self::$db->selectRow($select);
		return $this->init($row);
	}
	
}

?>