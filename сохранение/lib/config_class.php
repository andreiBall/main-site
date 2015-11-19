<?php
abstract class Config {
	const SITENAME = "ballbg.ru";//имя сайта
	const SECRET = "LRFSF7K";//хэш для пароля пользователя
	const ADDRESS = "http://mysite.local";//адрес сайта
	const ADM_NAME = "Георгий Баль";//имя админа
	const ADM_EMAIL = "gaddden@mail.ru";//электронный адрес админа
	const API_KEY = "DKEL39DL";//ключ для запросов на сервер (коментарии)
	const DB_HOST = "localhost";//адрес хоста
	const DB_USER = "root";//логин к базе
	const DB_PASSWORD = "";//пароль к базе
	const DB_NAME = "bal";//имя базы
	const DB_PREFIX = "xyz_";//префикс для таблиц в базе
	const DB_SYM_QUERY = "?";//нет
	const DIR_IMG = "/images/";//путь к папке с картинками для сайта
	const DIR_IMG_ARTICLES = "/images/article/";//путь к картинкам с новостям прозе стихам
	const DIR_AVATAR = "/images/avatar/";//путь к аватаркам пользователя
	const DIR_TMPL = "/tmpl/";//путь к tmpl файлам
	const DIR_EMAILS = "/tmpl/emails/";//путь к письмам пользователей
	const LAYOUT = "main";//нет
	const FILE_MESSAGES = "/text/messages.ini";//путь к файлу с сообщениями
	const FORMAT_DATE = "%d.%m.%Y %H:%M:%S";//формат даты
	const COUNT_ARTICLES_ON_PAGE = 3;//количество выводимых статей
	const COUNT_SHOW_PAGES = 10;//количество выводимых страниц
	const MIN_SEARCH_LEN = 3;//минимальный поисковый запрос
	const LEN_SEARCH_RES = 255;//макс количество символов для описания найденой статьи
	const SEF_SUFFIX = ".html";//нет
	const DEFAULT_AVATAR = "default.png";//имя аватарки по умолчанию
	const MAX_SIZE_AVATAR = 51200;//максимальный размер аватарки
}
?>