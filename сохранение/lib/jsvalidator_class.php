<?php
//адаптер проверка форм - смотреть так же validator.js
class JSValidator {
	
	private $message;//сообщение для пользователя
	
	public function __construct($message) {
		$this->message = $message;
	}
	
	/*-проверка поля пароль-*/
	public function password($f_equal = false, $min_len = true, $t_empty = false) {
		$cl = $this->getBase();//получаем класс с параметрами
		if ($min_len) {//если минимальная длинна указана
			$cl->min_len = ValidatePassword::MIN_LEN;//сравниваем мин длинну с введненым паролем
			$cl->t_min_len = $this->message->get(ValidatePassword::CODE_MIN_LEN);//если слишком маленькая длинна выводим сообщение
		}
		$cl->max_len = ValidatePassword::MAX_LEN;//сравниваем макс длинну с введненым паролем
		$cl->t_max_len = $this->message->get(ValidatePassword::CODE_MAX_LEN);//выводим сообщение
		if ($t_empty) $cl->t_empty = $this->message->get($t_empty);//проверяем является ли пустым
		else $cl->t_empty = $this->message->get(ValidatePassword::CODE_EMPTY);//выводим сообщение 
		if ($f_equal) {//если требуется совпадение с каким либо полем
			$cl->f_equal = $f_equal;//сравниваем
			$cl->t_equal = $this->message->get("ERROR_PASSWORD_CONF");//сообщаем если не совпало
		}
		return $cl;
	}
	
	/*-проверка поля имя-*/
	public function name($t_empty = false, $t_max_len = false, $t_type = false) {
		return $this->getBaseData($t_empty, $t_max_len, $t_type, "ValidateName", "name");
	}
	
	/*-проверка поля login-*/
	public function login($t_empty = false, $t_max_len = false, $t_type = false) {
		return $this->getBaseData($t_empty, $t_max_len, $t_type, "ValidateLogin", "login");
	}
	
	/*-проверка поля email-*/
	public function email($t_empty = false, $t_max_len = false, $t_type = false) {
		return $this->getBaseData($t_empty, $t_max_len, $t_type, "ValidateEmail", "email");
	}
	
	/*-проверка налчия автарки-*/
	public function avatar() {
		$cl = $this->getBase();
		$cl->t_empty = $this->message->get("ERROR_AVATAR_EMPTY");
		return $cl;
	}
	
	
	/*-проверка каптчи-*/
	public function captcha() {
		$cl = $this->getBase();
		$cl->t_empty = $this->message->get("ERROR_CAPTCHA_EMPTY");
		return $cl;
	}
	
	/*-шаблон для проверки данных из полей (пароль логин и т.д.)-*/
	private function getBaseData($t_empty, $t_max_len, $t_type, $class, $type) {
		$cl = $this->getBase();
		$cl->type = $type;
		$cl->max_len = $class::MAX_LEN;
		
		if ($t_empty) $cl->t_empty = $this->message->get($t_empty);
		else $cl->t_empty = $this->message->get($class::CODE_EMPTY);
		if ($t_max_len) $cl->t_max_len = $this->message->get($t_max_len);
		else $cl->t_max_len = $this->message->get($class::CODE_MAX_LEN);
		if ($t_type) $cl->t_type = $this->message->get($t_type);
		else $cl->t_type = $this->message->get($class::CODE_INVALID);
		return $cl;
	}
	
	/*-создание нового класса содержащего параметры для работы с полем-*/
	private function getBase() {
		$cl = new stdClass();
		$cl->type = "";//тип данных
		$cl->min_len = "";//мин. длинна поля
		$cl->max_len = "";//макс. длинна поля
		$cl->t_min_len = "";//текст для пользователя при мин. длинне поля
		$cl->t_max_len = "";//текст для пользователя при макс. длинне поля
		$cl->t_empty = "";//текст для пользователя если поле пустое
		$cl->t_type = "";//текст для пользователя если введен не коректный тип данных 
		$cl->f_equal = "";//поле для сравнения
		$cl->t_equal = "";//сообщение по сравнению
		return $cl;
	}

}

?>