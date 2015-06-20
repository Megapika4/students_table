<?php
	require_once "../lib/ajax_class.php"; //подключения класса для ajax запросов

		/* удаляет записи с таблицы по выбранным id */
	if(isset($_POST['del_row'])){		
		$checked_id = json_decode($_POST['checked_id']);
		$table = "students";
		$ajax = new Ajax();
		$ajax->del_from_table_with_id("students", $checked_id);		
	}
		
		/* добавляет запись в таблицу */
	if(isset($_POST['add_into'])){		
		$record_array = json_decode($_POST['record_array']);
		$record_array = (array)$record_array;
		$table = "students";
		$ajax = new Ajax();
		$ajax->add_into_table($table, $record_array);
	}
	
		/* редактирует записи */
	if(isset($_POST['update_row'])){
		$update_row = json_decode($_POST['update_row']);
		$table = "students";
		$ajax = new Ajax();
		for($i=0;$i<count($update_row);$i++){
			$this_row = (array)$update_row[$i];
			$this_id = $this_row['this_id']; //получает текущий id
			unset($this_row['this_id']); //удаляет значение id с массива
			$ajax->update_row($table, $this_row, $this_id); //изменение значений по id
		}
	}