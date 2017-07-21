<?php
	require_once "functions.php";
	require_once "src/Classes/AutoLoad/AutoLoad.php";
	AutoLoad::loadClasses();

	$templateSystem = new TemplateSystem();
	$templateSystem->loadTemplate("Users/login");
?>