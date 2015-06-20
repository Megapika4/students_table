<?php
	
class Model {
	
	private $mysqli; //������������� ����������
		
		/* �����������, ������������ � ��, ����������� ��������� ���������� */
	public function __construct($host, $user, $password, $db){
		$this->mysqli = new mysqli($host, $user, $password, $db);
		$this->mysqli->query("SET NAMES 'utf8'");
	}
	
	public function __destruct(){
		$this->mysqli->close();
	}
	
		/* ������� ������ (��� �������, ���� �� ������� WHERE) */
	public function get_date($table, $table_prefix, $where = ""){
		$return_date = array(); //������ ������������ ������
		if($where != ""){
				/* ��������� WHERE ������ */
			$where = " WHERE ";
			foreach($where as $key => $value){
				$where .= "`$key`='$value', ";
			}
			$where = substr($where, 0, strlen($where)-2); //������� ��������� ������� � ������
		}
		$table = $table_prefix.$table; 	//���������� �������� � �������� �������
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