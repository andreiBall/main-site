<?php
/*-модуль отвечающий за вывод статей-*/
class Blog extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("articles", null, true);//статьи
		$this->add("more_articles", null, true);//еще статьи
		$this->add("pagination");//нумерация под статьями
	}
	
	/*-коментарии - скланение-*/
	public function preRender() {
		foreach ($this->articles as $article) {
			$article->count_comments_text = $this->numberOf($article->count_comments, array("комментарий", "комментария", "комментариев"));
		}
	}
	
	/*-присваиваем tpl файл-*/
	public function getTmplFile() {
		return "blog";
	}
	
}

?>