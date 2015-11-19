<?php
//модуль отвечает за верхнее меню
class kruk extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("uri");//ссылка -активная открытая страница
		$this->add("items", null, true);//все пункты меню
	}
	
	/*-присваиваем tpl файл-*/
	public function getTmplFile() {
		return "kruk";
	}
	
}

?>