<?php
//общий валидатор обработка ошибок
abstract class Validator {
	
	const CODE_UNKNOWN = "UNKNOWN_ERROR";//системное сообщение об ошибке
	
	protected $data;//проверяемые данные
	private $errors = array();//свойство для хранения ошибок
	
	public function __construct($data) {
		$this->data = $data;
		$this->validate();
	}
	
	abstract protected function validate();//реализован в дочерних класах
	
	public function getErrors() {//возвращает массив ошибок
		return $this->errors;
	}
	
	public function isValid() {//возвращает сравнение кол-ва ошибок с нулем
		return count($this->errors) == 0;
	}
	
	protected function setError($code) {//добавление кода ошибки
		$this->errors[] = $code;
	}
	
	protected function isContainQuotes($string) {//защита от сиквел инъекций, запрет на кавычки
		$array = array("\"", "'", "`", "&quot;", "&apos;");//массив запрещенных значений
		foreach ($array as $value) {
			if (strpos($string, $value) !== false) return true;
		}
		return false;
	}
	
}

?>