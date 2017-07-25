<?php
	require_once "functions.php";
	require_once "src/Classes/AutoLoad/AutoLoad.php";
	AutoLoad::loadClasses();
	
	TemplateSystem::getInstance()->loadTemplate("/Users/login");
?>