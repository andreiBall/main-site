<?php
//вывод форм
class Form extends ModuleHornav {
	
	public function __construct() {
		parent::__construct();
		$this->add("name");//имя формы
		$this->add("action");//
		$this->add("method", "post");//
		$this->add("header");//заголовок
		$this->add("message");//текстовое сообщение
		$this->add("check", true);//необходимо ли проверять форму
		$this->add("enctype");//форма отправляющая помимо текста еще и файлы
		$this->add("inputs", null, true);//поля
		$this->add("jsv", null, true);//проверки
	}
	
	/*-проверка-*/
	public function addJSV($field, $jsv) {
		$this->addObj("jsv", $field, $jsv);
	}
	
	/*-текстовое поле-*/
	public function text($name, $label = "", $value = "", $default_v = "") {
		$this->input($name, "text", $label, $value, $default_v);
	}
	
	/*-поле пароля-*/
	public function password($name, $label = "", $default_v = "") {
		$this->input($name, "password", $label, "", $default_v);
	}
	
	/*-поле каптчи-*/
	public function captcha($name, $label) {
		$this->input($name, "captcha", $label);
	}
	
	/*-поле файл-*/
	public function file($name, $label) {
		$this->input($name, "file", $label);
	}
	
	/*-поле аватарка-*/
	public function fileIMG($name, $label, $img) {
		$this->input($name, "file_img", $label, $img);
	}
	
	/*--*/
	public function hidden($name, $value) {
		$this->input($name, "hidden", "", $value);
	}
	
	/*--*/
	public function submit($value, $name = false) {
		$this->input($name, "submit", "", $value);
	}
	
	/*--*/
	private function input($name, $type, $label, $value = false, $default_v = false) {
		$cl = new stdClass();
		$cl->name = $name;
		$cl->type = $type;
		$cl->label = $label;
		$cl->value = $value;
		$cl->default_v = $default_v;
		$this->inputs = $cl;
	}
	
	
	/*-присваиваем tpl файл-*/
	public function getTmplFile() {
		return "form";
	}
	
}

?>