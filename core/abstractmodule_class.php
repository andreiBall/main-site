<?php
//класс отвечающий за работу с модулями
abstract class AbstractModule {
	
	private $properties = array();//названия свойства 
	private $view;//шаблонизатор
	
	public function __construct($view) {
		$this->view = $view;
	}
	
	final protected function add($name, $default = null, $is_array = false) {//добавление нового свойства для модуля
		$this->properties[$name]["is_array"] = $is_array;
		if ($is_array && $default == null) $this->properties[$name]["value"] = array();
		else $this->properties[$name]["value"] = $default;
	}
	
	final public function __get($name) {//метод доступа
		if (array_key_exists($name, $this->properties)) return $this->properties[$name]["value"];
		return null;
	}
	
	final public function __set($name, $value) {//настройка свойств
		if (array_key_exists($name, $this->properties)) {
			if (is_array($this->properties[$name]["value"])) {
				if (is_array($value)) $this->properties[$name]["value"] = $value;
				else $this->properties[$name]["value"][] = $value;
			}
			else $this->properties[$name]["value"] = $value;
		}
		else return false;
	}
		
	
	
	final protected function getProperties() {
		$ret = array();
		foreach ($this->properties as $name => $value) {
			$ret[$name] = $value["value"];
		}
		return $ret;
	}
	
	/*-проверка формы-*/
	final protected function addObj($name, $field, $obj) {
		if (array_key_exists($name, $this->properties)) $this->properties[$name]["value"][$field] = $obj;
	}
	
	final protected function getComplexValue($obj, $field) {//метод работы с комплексными данными- парсим большие массивы 
		if (strpos($field, "->") !== false) $field = explode("->", $field);
		if (is_array($field)) {
			$value = $obj;
			foreach ($field as $f) $value = $value->{$f};
		}
		else $value = $obj->$field;
		return $value;
	}
	
	/*-преобразование модуля в строку-*/
	final public function __toString() {
		$this->preRender();
		return $this->view->render($this->getTmplFile(), $this->getProperties(), true);
	}
	
	protected function preRender() {}
	
	final protected function numberOf($number, $suffix) {//скланение слов связанных с числительными
		$keys = array(2, 0, 1, 1, 1, 2);
		$mod = $number % 100;
		$suffix_key = ($mod > 7 && $mod < 20) ? 2: $keys[min($mod % 10, 5)];
		return $suffix[$suffix_key];
	}
	
	abstract public function getTmplFile();//название тпл файла
	
}

?>