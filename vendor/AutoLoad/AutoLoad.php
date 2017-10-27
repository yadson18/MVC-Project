<?php 
	//A classe AutoLoad serve para carregar classes automaticamente no projeto.
	abstract class AutoLoad{
		/* 
		 * Este método carrega as classes automaticamente quando for necessário.
		 *	(string) rootDir, diretório raiz onde devem ser carregadas as classes (opcional),
		 * 	caso não seja passado nenhum valor, o diretório default para carregamento das
		 * 	classes, será o src.
		 */
		public static function loadClasses(){
			spl_autoload_register(function($className){
				$searchDir = function($className, $path) use (&$searchDir){
					$pathToArray = explode("/", $path);

					if(
						!in_array(".git", $pathToArray) &&
						!in_array("webroot", $pathToArray) &&
						!in_array("config", $pathToArray) &&
						!in_array("bin", $pathToArray)
					){
						if(is_dir($path)){
							$dirContents = array_diff(scandir($path), [".", ".."]);

							if(in_array("{$className}.php", $dirContents)){
								include $path.DS."{$className}.php";
								return true;
							}
							foreach($dirContents as $fileOrDir){
								if($searchDir($className, $path.DS.$fileOrDir)){
									return true;
								}
							}
						}
						return false;
					}
				};
				$searchDir($className, ROOT . DS);
			});
		}
	}