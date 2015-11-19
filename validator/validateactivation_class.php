<?php
//валидатор для проверки хэша
class ValidateActivation extends Validator {
	
	const MAX_LEN = 100;
	//кстати может реализовать проверку на цифры латинские символы и т.д.?
	protected function validate() {
		$data = $this->data;
		if (mb_strlen($data) > self::MAX_LEN) $this->setError(self::CODE_UNKNOWN);
	}
}

?>