<?php
//адаптер для работы с объектами
abstract class ObjectDB extends AbstractObjectDB {
	
	private static $months = array("янв.", "фев.", "март", "апр.", "май", "июн.", "июл.", "авг.", "сен.", "окт.", "ноя.", "дек.");//для краткого описания месяца по числу
	
	public function __construct($table) {
		parent::__construct($table, Config::FORMAT_DATE);//с передачей формата даты
	}
	
	protected static function getMonth($date = false) {//по дате месяца возвращает его имя
		if ($date) $date = strtotime($date);
		else $date = time();
		return self::$months[date("n", $date) - 1];
	}
	
	public function preEdit($field, $value) {//обработчик событий до редактирования объекта
		return true;
	}
	
	public function postEdit($field, $value) {//обработчик событий после редактирования объекта
		return true;
	}
	
	public function accessEdit($auth_user, $field) {
		return false;
	}
	
	public function accessDelete($auth_user) {
		return false;
	}
	
}

?>