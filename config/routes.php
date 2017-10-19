<?php  
	define("DS", DIRECTORY_SEPARATOR);

	define("ROOT", dirname(__DIR__));

	define("APP_DIR", "src");

	define("APP", ROOT . DS . APP_DIR . DS);

	define("CLASSES", APP . "Classes" . DS);

	define("VIEW", APP . "View" . DS);

	define("CONTROLLER", APP . "Controller" . DS);
	
	define("WWW_ROOT", ROOT . DS . "webroot" . DS);

	define("CONFIG", ROOT . DS . "config" . DS);
?>
