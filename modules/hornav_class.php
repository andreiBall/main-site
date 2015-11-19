<?php
//модуль для горизонтальной новигации
class Hornav extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("data", null, true);//массив с параметрами
	}
	
	/*--*/
	public function addData($title, $link = false) {
		$cl = new stdClass();
		$cl->title = $title;
		$cl->link = $link;
		$this->data = $cl;
	}
	
	/*-присваиваем tpl файл-*/
	public function getTmplFile() {
		return "hornav";
	}
	
}

?>