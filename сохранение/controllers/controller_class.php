<?php
//общий контролер
abstract class Controller extends AbstractController {
	
	protected $title;//заголовок страницы
	protected $meta_desc;//
	protected $meta_key;//ключевые слова
	protected $mail = null;//почта
	protected $url_active;//текущий адрес страницы
	protected $section_id = 0;//открытый раздел
	
	public function __construct() {
		parent::__construct(new View(Config::DIR_TMPL), new Message(Config::FILE_MESSAGES));//передаем шаблонизатор и др
		$this->mail = new Mail();
		$this->url_active = URL::deleteGET(URL::current(), "page");//присваиваем активную страницу удалив page
	}
	
	/*-вывод не существующей страницы-*/
	public function action404() {
		header("HTTP/1.1 404 Not Found");//поисковая оптимизация- вывод правильного заголовка
		header("Status: 404 Not Found");
		$this->title = "Страница не найдена - 404";
		$this->meta_desc = "Запрошенная страница не существует.";
		$this->meta_key = "страница не найдена, страница не существует, 404";
		
		$pm = new PageMessage();
		$pm->header = "Страница не найдена";
		$pm->text = "К сожалению, запрошенная страница не существует. Проверьте правильность ввода адреса.";
		$this->render($pm);
	}
	
	/*-доступ к странице закрыт-*/
	protected function accessDenied() {
		$this->title = "Доступ закрыт!";
		$this->meta_desc = "Доступ к данной странице закрыт.";
		$this->meta_key = "доступ закрыт, доступ закрыт страница, доступ закрыт страница 403";
		
		$pm = new PageMessage();
		$pm->header = "Доступ закрыт!";
		$pm->text = "У Вас нет прав доступа к данной странице.";
		$this->render($pm);
	}
	
	/*--*/
	final protected function render($str) {
		$params = array();
		$params["header"] = $this->getHeader();
		$params["auth"] = $this->getAuth();
		$params["top"] = $this->getTop();
		$params["left"] = $this->getLeft();
		//$params["kruk"] = $this->getKruk();
		$params["center"] = $str;
		$params["link_search"] = URL::get("search");
		$this->view->render(Config::LAYOUT, $params);
	}
	
	
	
	/*-формируем тег hed-*/
	protected function getHeader() {
		$header = new Header();
		$header->title = $this->title;
		$header->meta("Content-Type", "text/html; charset=utf-8", true);
		$header->meta("description", $this->meta_desc, false);
		$header->meta("keywords", $this->meta_key, false);
		$header->meta("viewport", "width=device-width", false);
		$header->favicon = "/favicon.ico";
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0') ) 
			$header->css = array("/styles/main.css", "/styles/prettify.css", "/styles/unite-gallery.css", "/styles/ie.css");
		elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/525.29') ) 
			$header->css = array("/styles/main.css", "/styles/prettify.css", "/styles/unite-gallery.css", "/styles/safari3.css");
		elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0') ) 
				$header->css = array("/styles/reject.css");
		elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') ) 
				$header->css = array("/styles/reject.css");
		elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 5.5') ) 
				$header->css = array("/styles/reject.css");			
		else
			$header->css = array("/styles/main.css", "/styles/prettify.css", "/styles/unite-gallery.css");
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0') ) 
			$header->js = array("/js/reject.min.js");
		elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') ) 
			$header->js = array("/js/reject.min.js");
		elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 5.5') ) 
			$header->js = array("/js/reject.min.js");	
		else
		$header->js = array("/js/jquery-11.0.min.js", "/js/functions.js", "/js/validator.js", "/js/prettify.js","/js/unitegallery.min.js", "/js/ug-theme-compact.js");

		return $header;
	}
	
	/*--*/
	protected function getAuth() {
		if ($this->auth_user) return "";
		$auth = new Auth();
		$auth->message = $this->fp->getSessionMessage("auth");
		$auth->action = URL::current("", true);
		$auth->link_register = URL::get("register");
		$auth->link_reset = URL::get("reset");
		$auth->link_remind = URL::get("remind");
		return $auth;
	}
	
	/*-формируем верхнее меню-*/
	protected function getTop() {
		$items = MenuDB::getTopMenu();
		$topmenu = new TopMenu();
		$topmenu->uri = $this->url_active;
		$topmenu->items = $items;
		return $topmenu;
	}
	
	
	
	
	
	/*-вывод левого меню-*/
	protected function getLeft() {
		$items = MenuDB::getMainMenu();
		$mainmenu = new MainMenu();
		$mainmenu->uri = $this->url_active;
		$mainmenu->items = $items;//меню левое
		$user_panel = "";
		if ($this->auth_user) {//панель пользователя для авторизированного
			$user_panel = new UserPanel();
			$user_panel->user = $this->auth_user;
			$user_panel->uri = $this->url_active;
			$user_panel->addItem("Редактировать профиль", URL::get("editprofile", "user"));
			$user_panel->addItem("Выход", URL::get("logout"));
		}
		else $user_panel = "";
		return $user_panel.$mainmenu;
	}
	
	
	
	/*-создаем хлебные крошки-*/
	protected function getHornav() {
		$hornav = new Hornav();
		$hornav->addData("Главная", URL::get(""));
		return $hornav;
	}
	
	/*-количество элементов на странице-*/
	final protected function getOffset($count_on_page) {
		return $count_on_page * ($this->getPage() - 1);
	}
	
	/*--*/
	final protected function getPage() {
		$page = ($this->request->page)? $this->request->page: 1;
		if ($page < 1) $this->notFound();
		return $page;
	}
	
	/*-вывод нумерации страниц-*/
	final protected function getPagination($count_elements, $count_on_page, $url = false) {
		$count_pages = ceil($count_elements / $count_on_page);//общее кол-во страниц
		$active = $this->getPage();//текущая страница
		if (($active > $count_pages) && ($active > 1)) $this->notFound();
		$pagination = new Pagination();
		if (!$url) $url = URL::deletePage(URL::current());
		$pagination->url = $url;
		$pagination->url_page = URL::addTemplatePage($url);
		$pagination->count_elements = $count_elements;
		$pagination->count_on_page = $count_on_page;
		$pagination->count_show_pages = Config::COUNT_SHOW_PAGES;
		$pagination->active = $active;
		return $pagination;
	}
	
	/*-авторизация пользователя-*/
	protected function authUser() {
		$login = "";
		$password = "";
		$redirect = false;
		if ($this->request->auth) {
			$login = $this->request->login;
			$password = $this->request->password;
			$redirect = true;
		}
		$user = $this->fp->auth("auth", "UserDB", "authUser", $login, $password);
		if ($user instanceof UserDB) {
			if ($redirect) $this->redirect(URL::current());
			return $user;
		}
		return null;
	}
	
}

?>