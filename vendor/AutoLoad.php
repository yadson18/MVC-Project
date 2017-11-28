<?php 
	//A classe AutoLoad serve para carregar classes automaticamente no projeto.
	class AutoLoad
	{
		private static $Instance;
		private static $paths;

		/* 
		 * Este método carrega as classes automaticamente quando for necessário.
		 *	(string) rootDir, diretório raiz onde devem ser carregadas as classes (opcional),
		 * 	caso não seja passado nenhum valor, o diretório default para carregamento das
		 * 	classes, será o src.
		 */

		private function __construct()
		{
			self::$paths = ["src", "vendor"];
		}

		public static function getInstance()
		{
			if (!isset(self::$Instance)) {
				self::$Instance = new AutoLoad();
			}
			return self::$Instance;
		}

		public function loadNameSpaces()
		{
            spl_autoload_register( function($className) {
            	$className = ucfirst(str_replace("\\", DS, $className ).".php"); 

            	foreach (self::$paths as $path) {
	                $ClassToLoad = ROOT . DS . $path . DS . $className;

	                if (file_exists($ClassToLoad)) {
	                	require_once $ClassToLoad;
	                	break;
		            }
            	}
            });
        }
	}