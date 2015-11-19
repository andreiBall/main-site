<?php
//контролер(общий)
abstract class AbstractController {
	
	protected $view;//шаблонизатор
	protected $request;//отвечает за хранение запросов
	protected $fp = null;//форм процессор - для работы с формами
	protected $auth_user = null;//авторизованный юзер
	protected $jsv = null;//валидатор javascript
	
	public function __construct($view, $message) {
		if (!session_id()) session_start();//статруем сесию
		$this->view = $view;
		$this->request = new Request();
		$this->fp = new FormProcessor($this->request, $message);
		$this->jsv = new JSValidator($message);
		$this->auth_user = $this->authUser();
		if (!$this->access()) {//проверяем доступ пользователя к странице
			$this->accessDenied();
			throw new Exception("ACCESS_DENIED");
		}
	}
	
	abstract protected function render($str);//вывод конечной страницы
	abstract protected function accessDenied();
	abstract protected function action404();
	
	protected function authUser() {
		return null;
	}
	
	protected function access() {
		return true;
	}
	
	final protected function notFound() {//редирект на страницу 404
		$this->action404();
	}
	
	final protected function redirect($url) {//редирект
		header("Location: $url");
		exit;
	}
	
	final protected function renderData($modules, $layout, $params = array()) {
		if (!is_array($modules)) return false;//если не массив возвращем ложь
		foreach ($modules as $key => $value) {//перебираем все модули
			$params[$key] = $value;
		}
		return $this->view->render($layout, $params, true);
	}
	
}

?>