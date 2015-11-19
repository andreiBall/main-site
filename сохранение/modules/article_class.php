<?php
/*-вывод статьи-*/
class Article extends ModuleHornav {
	
	public function __construct() {
		parent::__construct();
		$this->add("auth_user");//авторизованный пользователь
		$this->add("article");//данные статьи
		$this->add("prev_article");//сама статья
		$this->add("next_article");//следующая статья
		$this->add("link_register");//ссылка для регистрации
		$this->add("comments");//коментарии
	}
	
	/*-коментарии-*/
	protected function preRender() {
		$this->add("childrens");
		$childrens = array();
		foreach ($this->comments as $comment) {
			$childrens[$comment->id] = $comment->parent_id;
		}
		$this->childrens = $childrens;
	}
	
	public function getTmplFile() {
		return "article";
	}
	
}

?>