<?php
/*-объект -пользователь-*/
class UserDB extends ObjectDB {
	
	protected static $table = "users";//название таблицы в базе данных
	private $new_password = null;//новый пароль
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("login", "ValidateLogin");//логин
		$this->add("email", "ValidateEmail");//почта
		$this->add("password", "ValidatePassword");//пароль
		$this->add("name", "ValidateName");//ФИО
		$this->add("avatar", "ValidateIMG");//аватарка
		$this->add("date_reg", "ValidateDate", self::TYPE_TIMESTAMP, $this->getDate());//дата регистрации
		$this->add("activation", "ValidateActivation", null, $this->getKey());//активироан ли пользователь
	}
	
	/*-передача нового пароля-*/
	public function setPassword($password) {
		$this->new_password = $password;
	}
	
	/*-возвращение нового пароля-*/
	public function getPassword() {
		return $this->new_password;
	}
	
	/*-Загрузка данных пользователя по email-*/
	public function loadOnEmail($email) {
		return $this->loadOnField("email", $email);
	}
	
	/*-Загрузка данных пользователя по логину-*/
	public function loadOnLogin($login) {
		return $this->loadOnField("login", $login);
	}
	
	/*-обработка события после инициализации-*/
	protected function postInit() {
		if (is_null($this->avatar)) $this->avatar = Config::DEFAULT_AVATAR;//загрузка аватарки 
		$this->avatar = Config::DIR_AVATAR.$this->avatar;
		return true;
	}
	
	/*-проверка валидности*/
	protected function preValidate() {
		if ($this->avatar == Config::DIR_AVATAR.Config::DEFAULT_AVATAR) $this->avatar = null;
		if (!is_null($this->avatar)) $this->avatar = basename($this->avatar);
		if (!is_null($this->new_password)) $this->password = $this->new_password;//проверка пароля не равен ли нулю
		return true;
	}
	
	/*-преобразование пароля в хэш перед отпракой в базу-*/
	protected function postValidate() {
		if (!is_null($this->new_password)) $this->password = self::hash($this->new_password, Config::SECRET);
		return true;
	}
	
	/*-вход пользователя на сайт-*/
	public function login() {
		if ($this->activation != "") return false;//если пользователь не активирован
		if (!session_id()) session_start();//начинаем сесию (если не была начата)
		$_SESSION["auth_login"] = $this->login;//записываем в сесию логин и пароль пользователя
		$_SESSION["auth_password"] = $this->password;
	}
	
	/*-выход пользователя-*/
	public function logout() {
		if (!session_id()) session_start();//начинаем сесию (если не была начата)
		unset($_SESSION["auth_login"]);//удаляем из сесии логин и пароль пользователя
		unset($_SESSION["auth_password"]);
	}
	
	/*-удаление старой аватарки-*/
	public function getAvatar() {
		$avatar = basename($this->avatar);
		if ($avatar != Config::DEFAULT_AVATAR) return $avatar;
		return null;
	}
	
	/*-проверка пароля на соответствие-*/
	public function checkPassword($password) {
		return $this->password === self::hash($password, Config::SECRET);
	}
	
	/*-авторизация пользователя. возвращает авторизованного пользователя-*/
	public static function authUser($login = false, $password = false) {
		if ($login) $auth = true;//если передается логин значит авторизация - true, данные логина и пароля берутся из авторизации
		else {//значит проверка данных в сесии
			if (!session_id()) session_start();//стартуем сесию
			if (!empty($_SESSION["auth_login"]) && !empty($_SESSION["auth_password"])){//если логин и пароль не пустые
				$login = $_SESSION["auth_login"];//то данные берутся из сесии
				$password = $_SESSION["auth_password"];
			}
			else return;//если не авторизация и данные не из сесии значит вазвращаемся
			$auth = false;//а авторизация false
		}
		$user = new UserDB();
		if ($auth) $password = self::hash($password, Config::SECRET);//если авторизация переданный пароль хэшеруем
		$select = new Select();//ищем пользователя отвечаютщего запросу (соответствие логина пароля)
		$select->from(self::$table, array("COUNT(id)"))
			->where("`login` = ".self::$db->getSQ(), array($login))
			->where("`password` = ".self::$db->getSQ(), array($password));
		$count = self::$db->selectCell($select);//ищем количество соответствующих (логину паролю)пользователей
		if ($count) {
			$user->loadOnLogin($login);//загружаем пользователя
			if ($user->activation != "") throw new Exception("ERROR_ACTIVATE_USER");//если пользователь не активированн выводим ошибку
			if ($auth) $user->login();//если авторизация делаем логин
			return $user;//возвращаем юзера
		}
		if ($auth) throw new Exception("ERROR_AUTH_USER");//возвращаем ошибку если не был найден пользователем с таким логином и паролем
	}
	
	/*-секретный ключ отправляемый на почту для востановления пароля-*/
	public function getSecretKey() {
		return self::hash($this->email.$this->password, Config::SECRET);
	}
	
}

?>