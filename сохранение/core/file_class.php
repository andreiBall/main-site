<?php
//класс для работы с файлами
class File {
	
	//file-массив данных по файлу//max_size - максимальный размер файла//dir- куда загружается файл//
	//root-корневой каталог
	public static function uploadIMG($file, $max_size, $dir, $root = false, $source_name = false) {//проверка является ли файл изображением
		$blacklist = array(".php", ".phtml", ".php3", ".php4", ".html", ".htm");//проверка расширения
		foreach ($blacklist as $item)
			if (preg_match("/$item\$/i", $file["name"])) throw new Exception("ERROR_AVATAR_TYPE");
		$type = $file["type"];
		$size = $file["size"];
		if (($type != "image/jpg") && ($type != "image/jpeg") && ($type != "image/gif") && ($type != "image/png")) throw new Exception("ERROR_AVATAR_TYPE");//проверка типа файла
		if ($size > $max_size) throw new Exception("ERROR_AVATAR_SIZE");
		if ($source_name) $avatar_name = $file["name"];//смотрим имя файла//генерируем имя файла если не было
		else $avatar_name = self::getName().".".substr($type, strlen("image/"));//создаем расширение
		$upload_file = $dir.$avatar_name;//получаем путь картинки
		if (!$root) $upload_file = $_SERVER["DOCUMENT_ROOT"].$upload_file;//если не корневая директория- получаем корневыю директорию
		if (!move_uploaded_file($file["tmp_name"], $upload_file)) throw new Exception("UNKNOWN_ERROR");
		return $avatar_name;
	}
	
	public static function getName() {
		return uniqid();
	}
	
	public static function delete($file, $root = false) {//удаление файла по имени
		if (!$root) $file = $_SERVER["DOCUMENT_ROOT"].$file;//если не корневая директория- получаем корневыю директорию
		if (file_exists($file)) unlink($file);
	}
	
	public static function isExists($file, $root = false) {//проверка наличия файла на сервере
		if (!$root) $file = $_SERVER["DOCUMENT_ROOT"].$file;//если не корневая директория- получаем корневыю директорию
		return file_exists($file);
	}
}

?>