<?php
	require_once "functions.php";
	require_once "src/Classes/AutoLoad/AutoLoad.php";
	AutoLoad::loadClasses();
	
	$templateSystem = TemplateSystem::getInstance();
	$templateSystem->setDefaultTemplate([
		"controller" => "Sri",
		"view" => "index"
	]);
	$templateSystem->loadTemplate("/Sri/index");
?>