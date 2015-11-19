<?php
//валидатор проверка логина
class ValidateLogin extends Validator {
	
	const MAX_LEN = 100;//максимальный размер
	const CODE_EMPTY = "ERROR_LOGIN_EMPTY";//пустой логин
	const CODE_INVALID = "ERROR_LOGIN_INVALID";//некоректный логин
	const CODE_MAX_LEN = "ERROR_LOGIN_MAX_LEN";//максимальная длина
	
	protected function validate() {
		$data = $this->data;
		if (mb_strlen($data) == 0) $this->setError(self::CODE_EMPTY);//пустой логин
		else {
			if (mb_strlen($data) > self::MAX_LEN) $this->setError(self::CODE_MAX_LEN);//максимальная длина
			elseif ($this->isContainQuotes($data)) $this->setError(self::CODE_INVALID);//некоректный логин -  защита от сиквел инъекций, запрет на кавычки
		}
	}
	
}

?>