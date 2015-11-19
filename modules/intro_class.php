<?php
//хлебные крошки
class Intro extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("obj");
		$this->add("hornav");
	}
	
	public function getTmplFile() {
		return "intro";
	}
	
}

?>