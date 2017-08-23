<?php
	require_once "functions.php";
	require_once "src/Classes/AutoLoad/AutoLoad.php";
	AutoLoad::loadClasses();
	
	$templateSystem = TemplateSystem::getInstance();
	$templateSystem->setDefaultTemplate([
		"controller" => "Pages",
		"view" => "home"
	]);
	$templateSystem->loadTemplate("/Pages/home");
?>