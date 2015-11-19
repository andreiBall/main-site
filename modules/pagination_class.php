<?php
/*-нумерация страниц-*/
class Pagination extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("url");//
		$this->add("url_page");//
		$this->add("count_elements");//общее кол-во элементов
		$this->add("count_on_page");//кол-во элементов на одной странице
		$this->add("count_show_pages");//кол-во выводимых страниц
		$this->add("active");//активный url
	}
	
	/*-присваиваем tpl файл-*/
	public function getTmplFile() {
		return "pagination";
	}
	
}

?>