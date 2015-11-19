<?php
//класс для работы с сообщениями для пользователя
class Message {
	
	private $data;//ini файл с сообщениями
	
	public function __construct($file) {
		$this->data = parse_ini_file($file);
	}
	
	public function get($name) {
		return $this->data[$name];
	}
	
}

?>