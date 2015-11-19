<?php
//объект отвечает за банеры с курсами
class CourseDB extends ObjectDB {

	protected static $table = "courses";//название таблицы в базе данных
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("type", "ValidateCourseType");//тип курсов
		$this->add("header", "ValidateTitle");//заголовок
		$this->add("sub_header", "ValidateTitle");//заголовок
		$this->add("img", "ValidateIMG");//картинка
		$this->add("link", "ValidateURL");//ссылка
		$this->add("text", "ValidateText");//текст
		$this->add("did", "ValidateID");//идентификатор рассылки
		$this->add("latest", "ValidateBoolean");//новинка не новинка
		$this->add("section_ids", "ValidateIDs");//
	}
	
	/*-обработка события после инициализации-*/
	protected function postInit() {
		$this->img = Config::DIR_IMG.$this->img;//полный путь к картинке по константе
		return true;
	}
	
	/*-загрузка по id раздела конкретного курса-*/
	public function loadOnSectionID($section_id, $type) {
		$select = new Select();
		$select->from(self::$table, "*")
			->where("`type` = ".self::$db->getSQ(), array($type))
			->where("`latest` = ".self::$db->getSQ(), array(1))
			->rand();
		$data_1 = self::$db->select($select);
		$select = new Select();
		$select->from(self::$table, "*")
			->where("`type` = ".self::$db->getSQ(), array($type));
		if ($section_id) $select->whereFIS("section_ids", $section_id);
		$select->rand();
		$data_2 = self::$db->select($select);
		$data = array_merge($data_1, $data_2);
		if (count($data) == 0) {
			$select = new Select();
			$select->from(self::$table, "*")
				->where("`type` = ".self::$db->getSQ(), array($type))
				->rand();
			$data = self::$db->select($select);
		}
		$data = ObjectDB::buildMultiple(__CLASS__, $data);
		uasort($data, array(__CLASS__, "compare"));
		$first = array_shift($data);
		$this->load($first->id);
	}
	
	/*-сравнить-*/
	private function compare($value_1, $value_2) {
		if ($value_1->latest != $value_2->latest) return $value_1->latest < $value_2->latest;
		if ($value_1->type == $value_2->type) return 0;
		return $value_1->type > $value->type;
	}
	
}

?>