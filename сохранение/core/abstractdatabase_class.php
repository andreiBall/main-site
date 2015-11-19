<?php
//взаимодействий с базой данных
abstract class AbstractDataBase {

	private $mysqli;//идентификатор соединения
	private $sq;//строка заменяющая значение в запросах.безопасность 
	private $prefix;//префикс у таблиц в базе данных.безопасность
	
	protected function __construct($db_host, $db_user, $db_password, $db_name, $sq, $prefix){
		$this->mysqli = @new mysqli($db_host, $db_user, $db_password, $db_name);
		if ($this->mysqli->connect_errno) exit("Ошибка соединения с базой данных");
		$this->sq = $sq;
		$this->prefix = $prefix;
		$this->mysqli->query("SET lc_time_names = 'ru_RU'");
		$this->mysqli->set_charset("utf8");
	}
	
	public function getSQ() {//замена строки в запросе. безопасность
		return $this->sq;
	}
	
	public function getQuery($query, $params) {//замена строки в запросе. безопасность
		if ($params) {
			$offset = 0;
			$len_sq = strlen($this->sq);
			for ($i = 0; $i < count($params); $i++) {
				$pos = strpos($query, $this->sq, $offset);
				if (is_null($params[$i])) $arg = "NULL";
				else $arg = "'".$this->mysqli->real_escape_string($params[$i])."'";
				$query = substr_replace($query, $arg, $pos, $len_sq);
				$offset = $pos + strlen($arg);
			}
		}
		return $query;
	}
	
	public function select(AbstractSelect $select) {//выборка таблицы значений
		$result_set = $this->getResultSet($select, true, true);
		if (!$result_set) return false;
		$array = array();
		while (($row = $result_set->fetch_assoc()) != false)
			$array[] = $row;
		return $array;
	}
	
	public function selectRow(AbstractSelect $select) {//извлечение строки из таблицы
		$result_set = $this->getResultSet($select, false, true);
		if (!$result_set) return false;
		return $result_set->fetch_assoc();
	}
	
	public function selectCol(AbstractSelect $select) {// извлечение столбца из таблицы
		$result_set = $this->getResultSet($select, true, true);
		if (!$result_set) return false;
		$array = array();
		while (($row = $result_set->fetch_assoc()) != false) {
			foreach ($row as $value) {
				$array[] = $value;
				break;
			}
		}
		return $array;
	}
	
	public function selectCell(AbstractSelect $select) {//извлечение содержимого ячейки - к примеру получить логин по email пользователя
		$result_set = $this->getResultSet($select, false, true);
		if (!$result_set) return false;
		$arr = array_values($result_set->fetch_assoc());
		return $arr[0];
	}
	
	public function insert($table_name, $row) {//добавление данных в таблицу
		if (count($row) == 0) return false;//если массив пустой пропускаем
		$table_name = $this->getTableName($table_name);//получаем имя с префиксом
		$fields = "(";
		$values = "VALUES (";
		$params = array();
		foreach ($row as $key => $value) {
			$fields .= "`$key`,";
			$values .= $this->sq.",";
			$params[] = $value;
		}
		$fields = substr($fields, 0, -1);//удаляем лишние запятые
		$values = substr($values, 0, -1);
		$fields .= ")";
		$values .= ")";
		$query = "INSERT INTO `$table_name` $fields $values";
		return $this->query($query, $params);
	}
	
	public function update($table_name, $row, $where = false, $params = array()) {//изменение данных в таблице
		if (count($row) == 0) return false;
		$table_name = $this->getTableName($table_name);
		$query = "UPDATE `$table_name` SET ";
		$params_add = array();
		foreach ($row as $key => $value) {
			$query .= "`$key` = ".$this->sq.",";
			$params_add[] = $value;
		}
		$query = substr($query, 0, -1);
		if ($where) {
			$params = array_merge($params_add, $params);
			$query .= " WHERE $where";
		}
		return $this->query($query, $params);
	}
	
	public function delete($table_name, $where = false, $params = array()) {//удаление записей из таблицы
		$table_name = $this->getTableName($table_name);
		$query = "DELETE FROM `$table_name`";
		if ($where) $query .= " WHERE $where";
		return $this->query($query, $params);
	}
	
	public function getTableName($table_name) {//получение полного названия таблицы. безопасность
		return $this->prefix.$table_name;
	}
	
	private function query($query, $params = false) {//
		$success = $this->mysqli->query($this->getQuery($query, $params));
		if (!$success) return false;
		if ($this->mysqli->insert_id === 0) return true;
		return $this->mysqli->insert_id;
	}
	
	private function getResultSet(AbstractSelect $select, $zero, $one) {//проверка на запрошенное кол-во записей
		$result_set = $this->mysqli->query($select);
		if (!$result_set) return false;
		if ((!$zero) && ($result_set->num_rows == 0)) return false;
		if ((!$one) && ($result_set->num_rows == 1)) return false;
		return $result_set;
	}
	
	public function __destruct() {//освобождение ресурса
		if (($this->mysqli) && (!$this->mysqli->connect_errno)) $this->mysqli->close();
	}
	
}

?>