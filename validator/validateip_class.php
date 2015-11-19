<?php
//валидатор проверка IP
class ValidateIP extends Validator {
	
	protected function validate() {
		$data = $this->data;
		if ($data == 0) return;//нулевой IP принимаетсмя как правильный
		if (!preg_match("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", $data)) $this->setError(self::CODE_UNKNOWN);//проверка на соответствие стандарту
	}
	
}

?>