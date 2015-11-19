<?php
//модуль для работы с панелью пользователя
class UserPanel extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("user");//панель пользователя
		$this->add("uri");
		$this->add("items", null, true);//массив ссылок
	}
	
	/*-массив ссылок-*/
	public function addItem($title, $link) {
		$cl = new stdClass();
		$cl->title = $title;
		$cl->link = $link;
		$this->items = $cl;
	}
	
	/*-присваиваем tpl файл-*/
	public function getTmplFile() {
		return "user_panel";
	}
	
}

?>