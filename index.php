<?php
	require_once ROOT . DS . "functions.php";
	require_once APP . "Classes/AutoLoad/AutoLoad.php";

	AutoLoad::loadClasses();
	TemplateSystem::getInstance()->loadTemplate();