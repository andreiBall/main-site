<?php
//класс отвечающий за обработку форм
class FormProcessor {
	
	private $request;//отвечает за запрос
	private $message;//ошибка
	
	public function __construct($request, $message) {
		$this->request = $request;
		$this->message = $message;
	}
	
	//$message_name - хранимая в сесии ошибка//$obj - объект которым манипулирует форма (регистрация - юзер)
	//fields - массив(имена полей или константы)//checks-массив проверок и тестов (логин уникальный и т.д.)//success_message-сообщение для пользователя
	public function process($message_name, $obj, $fields, $checks = array(), $success_message = false) {
		try {
			if (is_null($this->checks($message_name, $checks))) return null;//проверка checks
			foreach ($fields as $field) {//заполняем объект данными
				if (is_array($field)) {//проверка является ли массивом
					$f = $field[0];
					$v = $field[1];
					if (strpos($f, "()") !== false) {//если метод
						$f = str_replace("()", "", $f);
						$obj->$f($v);
					}
					else $obj->$f = $v;
				}
				else $obj->$field = $this->request->$field;//берем данные из реквеста
			}
			if ($obj->save()) {//сохранение в базе данных
				if ($success_message) $this->setSessionMessage($message_name, $success_message);//сохраняем
				return $obj;
			}
		} catch (Exception $e) {//ошибки при сохранении
			$this->setSessionMessage($message_name, $this->getError($e));
			return null;
		}
	}
	
	public function checks($message_name, $checks) {//checks-массив проверок и тестов 
		try {
			for ($i =0; $i < count($checks); $i++) {//перебираем массив
				$equal = isset($checks[$i][3])? $checks[$i][3]: true;
				if ($equal && ($checks[$i][0] != $checks[$i][1])) throw new Exception($checks[$i][2]);//проверка на равенство
				elseif (!$equal && ($checks[$i][0] == $checks[$i][1])) throw new Exception($checks[$i][2]);
			}
			return true;
		} catch (Exception $e) {
			$this->setSessionMessage($message_name, $this->getError($e));
			return null;
		}
	}
	
	/*-авторизация пользователя-*/
	public function auth($message_name, $obj, $method, $login, $password) {
		try {
			$user = $obj::$method($login, $password);
			return $user;
		} catch (Exception $e) {
			$this->setSessionMessage($message_name, $this->getError($e));
			return false;
		}
	}
	
	public function setSessionMessage($to, $message) {
		if (!session_id()) session_start();//начинаем сесию если не начата
		$_SESSION["message"] = array($to => $message);
	}
	
	public function getSessionMessage($to) {
		if (!session_id()) session_start();//начинаем сесию если не начата
		if (!empty($_SESSION["message"]) && !empty($_SESSION["message"][$to])) {//проверяем пустой массив или нет
			$message = $_SESSION["message"][$to];
			unset($_SESSION["message"][$to]);//удаляем из сесии
			return $this->message->get($message);
		}
		return false;//если ошибок нет возвращаем ложь
	}
	
	//метод загрузки изображений//$message_name - хранимая в сесии ошибка//file-массив данных по файлу
	//max_size - максимальный размер файла//dir- куда загружается файл//source_name-имя файла на сервере
	public function uploadIMG($message_name, $file, $max_size, $dir, $source_name = false) {
		try {
			$name = File::uploadIMG($file, $max_size, $dir, false, $source_name);
			return $name;
		} catch (Exception $e) {//записали в сесию ошибку и закончили
			$this->setSessionMessage($message_name, $this->getError($e));
			return false;
		}
	}
	
	private function getError($e) {
		if ($e instanceof ValidatorException) {//если это объяленное исключение
			$error = current($e->getErrors());
			return $error[0];
		}
		elseif (($message = $e->getMessage())) return $message;
		return "UNKNOWN_ERROR";
	}
	
}

?>