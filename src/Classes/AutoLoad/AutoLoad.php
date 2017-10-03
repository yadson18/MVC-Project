<?php 
	//A classe AutoLoad serve para carregar classes automaticamente no projeto.
	abstract class AutoLoad{
		private static $classPaths;
		private static $rootDir;

		/* 
		 * Este método salva em uma variável estática, o diretório raiz onde devem ser 
		 * carregadas as classes.
		 *
		 * WWW_ROOT é uma constante onde está salvo o caminho até o diretório raiz do 
		 * projeto, visível globalmente no código.
		 *
		 * 	(string) rootDir, diretório raiz onde devem ser carregadas as classes.
		 */
		public static function setRootDir($rootDir){
			if(!empty($rootDir) && is_string($rootDir)){
				if(is_dir($rootDir)){
					self::$rootDir = WWW_ROOT . $rootDir;
				}
			}
			else{
				self::$rootDir = WWW_ROOT . "src/";
			}
		}

		/*
		 * Este método salva em uma variável estática, um array com as pastas 
		 * onde encontram-se as classes do sistema.
		 *
		 *	(array) paths, pastas onde encontram-se as classes.
		 */
		public static function setClassesPath($paths){
			if(is_array($paths)){
				self::$classPaths = $paths;
			}
		}

		// Este método retorna o diretório onde devem ser carregadas as classes.
		public static function getRootDir(){
			return self::$rootDir;
		}

		/* 
		 * Este método carrega as classes automaticamente quando for necessário.
		 *	(string) rootDir, diretório raiz onde devem ser carregadas as classes (opcional),
		 * 	caso não seja passado nenhum valor, o diretório default para carregamento das
		 * 	classes, será o src.
		 */
		public static function loadClasses($rootDir = null){
			if(!isset(self::$classPaths)){
				self::setClassesPath(getClassesPath());
			}
			self::setRootDir($rootDir);

			spl_autoload_register(function($class_name){
				foreach(self::$classPaths as $path){
					if(file_exists(self::getRootDir() . "{$path}/{$class_name}.php")){
						require_once self::getRootDir() . "{$path}/{$class_name}.php";
						break;
					}
				}
			});
		}
	}
?>