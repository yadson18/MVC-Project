<?php
	require_once CONFIG . "Functions/global-functions.php";
	require_once CONFIG . "Functions/config-functions.php";
	require_once VENDOR . "AutoLoad/AutoLoad.php";
	AutoLoad::loadClasses();
	TemplateSystem::getInstance()->loadTemplate();