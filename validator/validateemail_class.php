<?php
//валидатор для email
class ValidateEmail extends Validator {
	
	const MAX_LEN = 100;//максимальная длинна адреса
	const CODE_EMPTY = "ERROR_EMAIL_EMPTY";//пустой email
	const CODE_INVALID = "ERROR_EMAIL_INVALID";//не коректный email
	const CODE_MAX_LEN = "ERROR_EMAIL_MAX_LEN";//слишком большой email
	
	protected function validate() {
		$data = $this->data;
		if (mb_strlen($data) == 0) $this->setError(self::CODE_EMPTY);//проверяем введен ли email
		else {//проверяем длинну email
			if (mb_strlen($data) > self::MAX_LEN) $this->setError(self::CODE_MAX_LEN);
			else {//проверка на коректность
				$pattern = "/^[a-z0-9_][a-z0-9\._-]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+$/i";
				if (!preg_match($pattern, $data)) $this->setError(self::CODE_INVALID);
			}
		}
	}
	
}

?>