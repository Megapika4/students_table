<?php
	require_once "config_class.php";

class Ajax{
	
	protected $mysqli;
	protected $config;
	
	public function __construct(){
		$this->config = new Config();
		$this->mysqli = new mysqli($this->config->host, $this->config->user, $this->config->password, $this->config->db);
		$this->mysqli->query("SET NAMES 'utf8'");
	}
	
	public function __destruct(){
		$this->mysqli->close();
	}
	
		/* удаляет записи с таблицы по выбранным id */
	public function del_from_table_with_id($table, $array){
		$table = $this->config->db_prefix.$table;
		for($i=0;$i<count($array);$i++){
			$where .= "`id`='$array[$i]' , ";
			$query = "DELETE FROM $table WHERE `id`='$array[$i]'";
			$this->mysqli->query($query);
		}
	}
	
		/* добавляет запись в таблицу */
	public function add_into_table($table, $array){
		$values = "(";
		$index = "(";
		foreach($array as $key => $val){
			$values .= "'$val', ";
			$index .= "`$key`, ";
		}
		$values = substr($values, 0, strlen($values)-2).")";
		$index = substr($index, 0, strlen($index)-2).")";
		$table = $this->config->db_prefix.$table;
		$query = "INSERT INTO $table $index VALUES $values";
		$this->mysqli->query($query);		
	}
	
		/* редактирует записи */
	public function update_row($table, $this_row, $id){
		$set = " ";
		foreach($this_row as $key => $val){
		  $set .= "`$key`='$val', ";
		}
		$set = substr($set, 0, strlen($set)-2);
		$table = $this->config->db_prefix.$table;
		$query = "UPDATE $table SET $set WHERE `id`='$id'";
		echo $query;
		$this->mysqli->query($query);
	}	
}