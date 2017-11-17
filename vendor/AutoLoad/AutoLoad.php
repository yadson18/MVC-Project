<?php 
	//A classe AutoLoad serve para carregar classes automaticamente no projeto.
	class AutoLoad{
		private static $Instance;
		private $paths = ["src", "vendor"];

		/* 
		 * Este método carrega as classes automaticamente quando for necessário.
		 *	(string) rootDir, diretório raiz onde devem ser carregadas as classes (opcional),
		 * 	caso não seja passado nenhum valor, o diretório default para carregamento das
		 * 	classes, será o src.
		 */

		private function __construct(){}

		public static function getInstance(){
			if(!isset(self::$Instance)){
				self::$Instance = new AutoLoad();
			}
			return self::$Instance;
		}

		public function loadNameSpaces(){
            spl_autoload_register(function($className){
            	$className = str_replace("\\", DS, $className ).".php";

            	foreach ($this->paths as $path) {
	                $Class = ROOT . DS . $path . DS . $className;

	                if(file_exists($Class)){
	                	require_once $Class;
	                	break;
		            }
            	}
            });
        }
	}