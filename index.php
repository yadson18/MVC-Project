<?php
	require_once VENDOR."AutoLoad/AutoLoad.php";
	AutoLoad::loadClasses();
	
	require_once CONFIG."Functions".DS."global-functions.php";
	require_once CONFIG."AppConfig.php";

	TemplateSystem::getInstance()->loadTemplate();