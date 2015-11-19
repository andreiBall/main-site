<?php
//вывод форм авторизации ссылки на пароль и т.д.
class Auth extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("action");//фаорма авторизации
		$this->add("message");//сообщения для пользователя
		$this->add("link_register");//ссылка на регистацию
		$this->add("link_reset");//ссылка на востановление пароля
		$this->add("link_remind");//ссылка на востановление логина
	}
	
	public function getTmplFile() {
		return "auth";
	}
	
}

?>