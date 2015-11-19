<?php
//валидатор проверка пароля
class ValidatePassword extends Validator {
	
	const MIN_LEN = 6;//минимальная длинна
	const MAX_LEN = 100;//максимальная длина
	const CODE_EMPTY = "ERROR_PASSWORD_EMPTY";//пустой
	const CODE_CONTENT = "ERROR_PASSWORD_CONTENT";//проверка на содержимое
	const CODE_MIN_LEN = "ERROR_PASSWORD_MIN_LEN";//меньше минимальной длинны
	const CODE_MAX_LEN = "ERROR_PASSWORD_MAX_LEN";//больше максимальной длинны
	
	protected function validate() {
		$data = $this->data;
		if (mb_strlen($data) == 0) $this->setError(self::CODE_EMPTY);//пустой
		else {
			if (mb_strlen($data) < self::MIN_LEN) $this->setError(self::CODE_MIN_LEN);//меньше минимальной длинны
			elseif (mb_strlen($data) > self::MAX_LEN) $this->setError(self::CODE_MAX_LEN);//больше максимальной длинны
			elseif (!preg_match("/^[a-z0-9_]+$/i", $data)) $this->setError(self::CODE_CONTENT);
		}
	}
	
}

?>