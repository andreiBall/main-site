<?php
//отвечает за хранение всех ошибок в виде исключения
class ValidatorException extends Exception {
//	ValidatorException дочерний от встроенного в PHP Exception
	private $errors;
	
	public function __construct($errors) {
		parent::__construct();//вызываем родительский конструктор
		$this->errors = $errors;
	}
	
	public function getErrors() {//получение ошибок
		return $this->errors;
	}
	
}

?>