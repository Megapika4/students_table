<?php

	require_once "lib/controller_class.php"; //подключение контроллера
	
	$controller = new Controller();

	$page = $controller->getPage("index"); //формирует главную страницу
		
	echo $page;