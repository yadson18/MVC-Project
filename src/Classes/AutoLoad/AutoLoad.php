<?php 
	//A classe AutoLoad serve para carregar classes automaticamente no projeto.
	abstract class AutoLoad{
		private static $classPaths;
		private static $rootDir;

		/* 
		 * Este método salva em uma variável estática, o diretório raiz onde devem ser 
		 * carregadas as classes.
		 *
		 * ROOT é uma constante onde está salvo o caminho até o diretório raiz do 
		 * projeto, visível globalmente no código.
		 *
		 * 	(string) rootDir, diretório onde as classes deverão ser buscadas e carregadas.
		 *		Obs: Cado não seja passado senhum valor, por padrão, o diretório será o "src".
		 */
		public static function setRootDir($rootDir){
			if(!empty($rootDir) && is_dir($rootDir)){
				self::$rootDir = ROOT . DS . $rootDir;
			}
			else{
				self::$rootDir = APP;
			}
		}

		/*
		 * Este método salva em uma variável estática, um array com os diretórios 
		 * onde encontram-se as classes do sistema.
		 *
		 *	(array) paths, diretórios onde encontram-se as classes.
		 */
		public static function setClassesPath(array $paths){
			if(!empty($paths)){
				self::$classPaths = $paths;
			}
		}

		// Este método retorna o diretório onde devem ser carregadas as classes.
		protected static function getRootDir(){
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