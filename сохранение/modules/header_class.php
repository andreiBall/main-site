<?php
//модуль для работы с метатегами и др в head
class Header extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("title");//заголовок
		$this->add("favicon");//картинка для сайта с расширением ico
		$this->add("meta", null, true);//массив метатегов
		$this->add("css", null, true);//массив стилей
		$this->add("js", null, true);//массив js
	}
	
	/*-добавление массива метатега-*/
	public function meta($name, $content, $http_equiv) {
		$class = new stdClass();
		$class->name = $name;//название
		$class->content = $content;//содержание
		$class->http_equiv = $http_equiv;//тип
		$this->meta = $class;//добавляем к свойству Meta массив class
	}
	
	/*-присваиваем tpl файл-*/
	public function getTmplFile() {
		return "header";//метод пренадлежит файлу tpl header
	}
	
}

?>