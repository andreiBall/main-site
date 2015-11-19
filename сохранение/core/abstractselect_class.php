<?php
//класс отвечает за работу запроса SELECT
class AbstractSelect {
	
	private $db;//объект - AbstractDataBase
	private $from = "";//таблица из которой делается выборка
	private $where = "";//предикат условия выборки
	private $order = "";//сортировка
	private $limit = "";//количество извлекаемых записей и смещение выборки
	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function from($table_name, $fields) {//запись в объект AbstractSelect значения from
		$table_name = $this->db->getTableName($table_name);//получение полного названия таблицы
		$from = "";
		if ($fields == "*") $from = "*";//если параметры * возвращаем запрос ко всем  столбцам
		else {//если перечисляется массив конкретных записей
			for ($i = 0; $i < count($fields); $i++) {
				if (($pos_1 = strpos($fields[$i], "(")) !== false) {//проверяем является ли извлекаемое поле функцией. Ищем открывающую скобку
					$pos_2 = strpos($fields[$i], ")");//ищем закрывающую скобку
					$from .= substr($fields[$i], 0, $pos_1)."(`".substr($fields[$i], $pos_1 + 1, $pos_2 - $pos_1 - 1)."`),";// добавляем ` к названиям столбцов (к примеру (ID)=(`ID`))
				}
				else $from .= "`".$fields[$i]."`,";
			}
			$from = substr($from, 0, -1);// удаляем лишнюю запятую
		}
		$from .= " FROM `$table_name`";
		$this->from = $from;
		return $this;
	}
	
	public function where($where, $values = array(), $and = true) {//добавление предиката в запрос
		if ($where) {
			$where = $this->db->getQuery($where, $values);
			$this->addWhere($where, $and);//добавляем в поле private $where
		}
		return $this;
	}
	
	public function whereIn($field, $values, $and = true) {//добавление предиката IN в запрос
		$where = "`$field` IN (";
		foreach ($values as $value) {
			$where .= $this->db->getSQ().",";//знак ?
		}
		$where = substr($where, 0, -1);//убираем послуднюю запятую
		$where .= ")";
		return $this->where($where, $values, $and);
	}
	
	public function whereFIS($col_name, $value, $and = true) {//был удален
		$where = "FIND_IN_SET (".$this->db->getSQ().", `$col_name`) > 0";
		return $this->where($where, array($value), $and);
	}
	
	public function order($field, $ask = true) {//отладка сортировки - по какому полю и по взрастанию или убыванию
		if (is_array($field)) {//проверка если массив полей
			$this->order = "ORDER BY ";
			if (!is_array($ask)) {//проверка елси не массив
				$temp = array();
				for ($i = 0; $i < count($field); $i++) $temp[] = $ask;
				$ask = $temp;
			}
			for ($i = 0; $i < count($field); $i++) {
				$this->order .= "`".$field[$i]."`";
				if (!$ask[$i]) $this->order .= " DESC,";//по убыванию
				else $this->order .= ",";//по возрастанию
			}
			$this->order = substr($this->order, 0, -1);//удаление лишней запятой
		}
		else {//если одно поле
			$this->order = "ORDER BY `$field`";
			if (!$ask) $this->order .= " DESC";//по убыванию
		}
		return $this;
	}
	
	public function limit($count, $offset = 0) {//колличество принимаемых записей
		$count = (int) $count;//в целяях безопасности преобразуем в целый тип. безопасность от сиквел инъекций
		$offset = (int) $offset;
		if ($count < 0 || $offset < 0) return false;//убираем отрицательные 
		$this->limit = "LIMIT $offset, $count";
		return $this;
	}
	
	public function rand() {//извлечение случайных записей
		$this->order = "ORDER BY RAND()";
		return $this;
	}
	
	public function __toString() {//преобразует объект в строку
		if ($this->from) $ret = "SELECT ".$this->from." ".$this->where." ".$this->order." ".$this->limit;
		else $ret = "";
		return $ret;
	}
	
	private function addWhere($where, $and) {//обработка предиката добавление AND или OR
		if ($this->where) {//если придикат есть
			if ($and) $this->where .= " AND ";//проверяем значение предиката -если  AND то добавляем AND
			else $this->where .= " OR ";// иначе добавляем к веру OR
			$this->where .= $where;
		}
		else $this->where = "WHERE $where";//если where не было
	}
}

?>