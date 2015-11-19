<?php
//модуль для вывода категорий
class Category extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("category");//категории 
		$this->add("articles", null, true);//статьи
	}
	
	/*-коментарии - скланение-*/
	public function preRender() {
		foreach ($this->articles as $article) {
			$article->count_comments_text = $this->numberOf($article->count_comments, array("комментарий", "комментария", "комментариев"));
		}
	}
	
	/*-присваиваем tpl файл-*/
	public function getTmplFile() {
		return "category";
	}
	
}

?>