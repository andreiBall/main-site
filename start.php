<?php
	mb_internal_encoding("UTF-8");//кодировка
	error_reporting(E_ALL);//вывод всех ошибок
	ini_set("display_errors", 1);//вывод ошибок на экран
	
	set_include_path(get_include_path().PATH_SEPARATOR."core".PATH_SEPARATOR."lib".PATH_SEPARATOR."objects".PATH_SEPARATOR."validator".PATH_SEPARATOR."controllers".PATH_SEPARATOR."modules");//адресация для PHP путь к файлам
	spl_autoload_extensions("_class.php");//расширение для классов 
	spl_autoload_register();//автозагрузка классов
	
	define("MAINMENU", 1);//константы главное меню
	define("TOPMENU", 2);//вспомогательное меню
	define("KB_B", 1024);//байт в килобайте
	define("PAY_COURSE", 1);
	define("FREE_COURSE", 2);
	define("ONLINE_COURSE", 3);
	
	AbstractObjectDB::setDB(DataBase::getDBO());//единичное подключение к базе
	
?>