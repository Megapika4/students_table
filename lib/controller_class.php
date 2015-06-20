<?php
	
	require_once "config_class.php";
	require_once "model_class.php";
	require_once "view_class.php";
	
class Controller {
	
	protected $model;
	protected $view;
	protected $config;
	
	public function __construct(){
		$this->config = new Config();
		$this->model = new Model($this->config->host, $this->config->user, $this->config->password, $this->config->db);
		$this->view = new View();
	}
		
		/* формирует страницы */
	public function getPage($page){
		if($page == "index"){
			$title = "Список студентов";
			
			/* Главная страница */
			$students_date = $this->model->get_date("students", $this->config->db_prefix);
			$date_count = count($students_date); //количество записей в таблице
			
					/* Формирование таблицы */
			for($i=0;$i<$date_count;$i++){
				$table_body .= $this->view->generate("table_body.tpl", $students_date[$i])."\n";
			}				
			$table_replace = array("table_body" => $table_body);
			$table = $this->view->generate("stud_table.tpl", $table_replace);
			
				/* тело страницы */
			$container_replace = array("table" => $table, "students_count" => $date_count);
			$container = $this->view->generate("container.tpl", $container_replace);
			
				/* возвращаемая страница */
			$index_replace = array("container" => $container, "title" => "Список студентов");
			$text_return = $this->view->generate("index.tpl", $index_replace);
				
		}		
		return $text_return;
	}	
	
}


