<?php
	
class Model {
	
	private $mysqli; //Идентификатор соединения
		
		/* Конструктор, подключается к БД, уставливает кодировку соединения */
	public function __construct($host, $user, $password, $db){
		$this->mysqli = new mysqli($host, $user, $password, $db);
		$this->mysqli->query("SET NAMES 'utf8'");
	}
	
	public function __destruct(){
		$this->mysqli->close();
	}
	
		/* Выборка данных (всю таблицу, либо по условию WHERE) */
	public function get_date($table, $table_prefix, $where = ""){
		$return_date = array(); //массив возвращаемых данных
		if($where != ""){
				/* Формирует WHERE запрос */
			$where = " WHERE ";
			foreach($where as $key => $value){
				$where .= "`$key`='$value', ";
			}
			$where = substr($where, 0, strlen($where)-2); //удаляет последнюю запятую и пробел
		}
		$table = $table_prefix.$table; 	//добавление префикса к названию таблицы
		$query = "SELECT * FROM $table".$where;
		$result = $this->mysqli->query($query);
		if(!$result){
			return false;
		}
			$i = 0;
		while($row = $result->fetch_assoc()){
			$return_date[$i] = array();
			foreach($row as $key => $value){
				$return_date[$i][$key] = $value;
			}
			$i++;
		}
		return $return_date;
	}
	
}