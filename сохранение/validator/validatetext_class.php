<?php
//валидатор проверка текста статьи книг новостей // админка
class ValidateText extends Validator {
	
	const MAX_LEN = 50000;//максимальная длинна
	const CODE_EMPTY = "ERROR_TEXT_EMPTY";//пустой
	const CODE_MAX_LEN = "ERROR_TEXT_MAX_LEN";//превысил длинну
	
	protected function validate() {
		$data = $this->data;
		if (mb_strlen($data) == 0) $this->setError(self::CODE_EMPTY);
		elseif (mb_strlen($data) > self::MAX_LEN) $this->setError(self::CODE_MAX_LEN);
	}
	
}

?>