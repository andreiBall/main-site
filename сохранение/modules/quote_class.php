<?php
//модуль для цитат
class Quote extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("quote");//все пункты цитат
	}
	
	/*-присваиваем tpl файл-*/
	public function getTmplFile() {
		return "quote";
	}
	
}

?>