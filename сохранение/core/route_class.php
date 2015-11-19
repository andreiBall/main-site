<?php
//маршрутизатор - получает контролер и экшн от URL.начало работы сайта
class Route {
	
	public static function start() {
		$ca_names = URL::getControllerAndAction();//получаем имена контролера и экшна
		$controller_name = $ca_names[0]."Controller";//вызвываем контролер
		$action_name = "action".$ca_names[1];//вызываем экшн
		try {//создаем
			if (class_exists($controller_name)) $controller = new $controller_name();
			if (method_exists($controller, $action_name)) $controller->$action_name();
			else throw new Exception();//иначе возвращаем исключение
		} catch (Exception $e) {//иначе вызываем метод 404
			if ($e->getMessage() != "ACCESS_DENIED") $controller->action404();//если доступ не закрыт значит обращается к не существующей странице
		}
	}
	
}

?>