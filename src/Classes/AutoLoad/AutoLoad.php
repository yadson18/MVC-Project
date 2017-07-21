<?php 
	//A classe AutoLoad serve para carregar classes automaticamente no projeto.
	abstract class AutoLoad{
		/* 
		 * Para este atributo, é necessário um array com os diretórios onde encontram-se todas
		 * as classes do projeto a partir do diretório src ou do diretório especificado pelo 
		 * método setRootDir. 
		 */
		private static $classPaths = [
			"Classes/Datasource", 
			"Classes/TemplateSystem",
			"Classes/TemplateSystem/TemplateTraits",
			"Classes/Webservice",
			"Controller", 
			"Controller/ControllerTraits"
		];
		private static $rootDir;

		/* 
		 * Este método salva em uma variável estática, o diretório raiz onde devem ser 
		 * carregadas as classes.
		 * (string) rootDir, diretório raiz onde devem ser carregadas as classes.
		 */
		public static function setRootDir($rootDir){
			if(!empty($rootDir) && is_string($rootDir)){
				if(is_dir($rootDir)){
					self::$rootDir = $rootDir;
				}
			}
			else{
				self::$rootDir = $_SERVER['DOCUMENT_ROOT'] . "/src/";
			}
		}

		// Este método retorna o diretório onde devem ser carregadas as classes.
		public static function getRootDir(){
			return self::$rootDir;
		}

		/* 
		 * Este método carrega as classes automaticamente quando for necessário,
		 * (string) rootDir, diretório raiz onde devem ser carregadas as classes (opcional),
		 * caso não seja passado nenhum valor, o diretório default para carregamento das
		 * classes, será o src.
		 */
		public static function loadClasses($rootDir = null){
			self::setRootDir($rootDir);
			spl_autoload_register(function($class_name){
				foreach(self::$classPaths as $path){
					if(
						is_file(self::getRootDir() . "{$path}/{$class_name}.php") && 
						file_exists(self::getRootDir() . "{$path}/{$class_name}.php")
					){
						require_once self::getRootDir() . "{$path}/{$class_name}.php";
						break;
					}
				}
			});
		}
	}
?>