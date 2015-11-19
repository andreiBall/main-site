<?php
//валидатор проверка описания в метатегах//для админки
class ValidateMD extends Validator {
	
	const MAX_LEN = 255;//максимальная длинна
	const CODE_EMPTY = "ERROR_MD_EMPTY";//пустой
	const CODE_MAX_LEN = "ERROR_MD_MAX_LEN";//максимальная длинна
	
	protected function validate() {
		$data = $this->data;
		if (mb_strlen($data) == 0) $this->setError(self::CODE_EMPTY);//пустой
		if (mb_strlen($data) > self::MAX_LEN) $this->setError(self::CODE_MAX_LEN);//максимальная длинна
	}
	
}

?>