<?php
//шаблонизатор работа с файлами tpl
class View {
	
	private $dir_tmpl;// директория в которой ханятся tpl файлы
	
	public function __construct($dir_tmpl) {
		$this->dir_tmpl = $dir_tmpl;
	}
	
	public function render($file, $params, $return = false) {//обработка tpl файла
		$template = $this->dir_tmpl.$file.".tpl";//подключаем файл
		extract($params);//извлекаем параметры из массива
		ob_start();//собираем  в буфер содержимое файла
		include($template);
		if ($return) return ob_get_clean();//если нужно вернуть возвращаем
		else echo ob_get_clean();//иначе сразу выводим
	}
}

?>