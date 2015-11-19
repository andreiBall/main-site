<?php
//модуль слайдера или хедера к курсам
class Slider extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("course");//все пункты слайдера
	}
	
	/*-присваиваем tpl файл-*/
	public function getTmplFile() {
		return "slider";
	}
	
}

?>