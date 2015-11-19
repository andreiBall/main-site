<?php
//валидатор проверка имени 
class ValidateName extends Validator {
	
	const MAX_LEN = 100;//максимальная длинна 
	const CODE_EMPTY = "ERROR_NAME_EMPTY";//пустой
	const CODE_INVALID = "ERROR_NAME_INVALID";//не коректное имя
	const CODE_MAX_LEN = "ERROR_NAME_MAX_LEN";//максимальная длинна превышена
	
	protected function validate() {
		$data = $this->data;
		if (mb_strlen($data) == 0) $this->setError(self::CODE_EMPTY);
		else {
			if (mb_strlen($data) > self::MAX_LEN) $this->setError(self::CODE_MAX_LEN);
			elseif ($this->isContainQuotes($data)) $this->setError(self::CODE_INVALID);//некоректное имя -  защита от сиквел инъекций, запрет на кавычки
		}
	}
	
}

?>