<?php  
	// Separador de diretórios.
	define("DS", DIRECTORY_SEPARATOR);

	// Diretório raiz.
	define("ROOT", dirname(__DIR__));

	define("APP_DIR", "src");

	// Rota para o diretŕoio "src".
	define("APP", ROOT . DS . APP_DIR . DS);

	// Rota para o diretório "Classes".
	define("CLASSES", APP . "Classes" . DS);

	// Rota para o diretório "View".
	define("VIEW", APP . "View" . DS);

	define("CONTROLLER", APP . "Controller" . DS);
	
	define("WWW_ROOT", ROOT . DS . "webroot" . DS);

	define("CONFIG", ROOT . DS . "config" . DS);