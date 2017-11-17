<?php  
	// Separador de diretórios.
	define("DS", DIRECTORY_SEPARATOR);

	// Abaixo estão definidas as constantes, que guardarão os caminhos
	// para os diretórios do sistema e estarão visíveis globalmente.

	// Diretório raiz do projeto.
	define("ROOT", dirname(__DIR__));

	define("APP_DIR", "src");

	// Diretŕoio "src".
	define("APP", ROOT . DS . APP_DIR . DS);

	// Diretório "Controller".
	define("CONTROLLER", APP . "Controller" . DS);

	// Diretório "Model".
	define("MODEL", APP . "Model" . DS);
	
	// Diretório "View".
	define("VIEW", APP . "View" . DS);
	
	// Diretório "webroot".
	define("WWW_ROOT", ROOT . DS . "webroot" . DS);

	// Diretório "config".
	define("CONFIG", ROOT . DS . "config" . DS);

	// Diretório "vendor".
	define("VENDOR", ROOT . DS . "vendor" . DS);