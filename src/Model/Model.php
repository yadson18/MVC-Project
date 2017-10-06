<?php  
	abstract class Model implements ModelInterface{
		private static $dbConfigs = [
			"firebird" => [
				"dbUsers" => "users",
				"dbApplication" => "applicationBase"
			]
		];

		public static function newEntity(){
			return new stdClass();
		}

		public static function getLoggedUser(){
			if(isset($_SESSION["id"])){
				if(isset($_SESSION[$_SESSION["id"]]["object"])){	
					if(is_callable([$_SESSION[$_SESSION["id"]]["object"], "getLoggedUser"])){
						if(!empty($_SESSION[$_SESSION["id"]]["object"]->getLoggedUser())){
							return $_SESSION[$_SESSION["id"]]["object"]->getLoggedUser();
						}
					}
				}
			}
			return false;
		}

		public static function patchEntity($entity, $arrayAttributes){
			if(is_object($entity)){
				if(is_array($arrayAttributes) && !empty($arrayAttributes)){
					foreach($arrayAttributes as $attribute => $attributeValue){
						$attribute = self::formatAttributeName($attribute);

						$entity->{$attribute} = $attributeValue;
					}
					return $entity;
				}
			}
			return false;
		}

		public static function formatAttributeName($attributeName){
			$attributeName = ucwords(strtolower(str_replace(["_", "."], " ", $attributeName)));
			return lcfirst(str_replace(" ", "", $attributeName));
		}

		public function get($baseName, $columns, $tables, $arrayConditions = null){
			foreach(self::$dbConfigs as $baseType => $name){
				/*if(self::getLoggedUser()){
					$userId = self::getLoggedUser()->codCadastro;

					setDatabaseConfig($baseType, $name[$baseName], [
						"dbPath" => "C:\SRI\DADOSVR\\{$userId}\\BD\SRICASH.FDB"
					]);
				}*/
			
				if(array_key_exists($baseName, self::$dbConfigs[$baseType])){
					$dbConnection = new DatabaseConnect(getDatabaseConfig($baseType, $name[$baseName]));

					if(is_string($columns) && is_string($tables)){
					 	if(!empty($arrayConditions)){
					 		$top = 0;
					 		$condition = "WHERE";
					 		$valuesToCompare = [];
					 		
					 		foreach($arrayConditions as $operator => $values){
					 			if($dbConnection->queryOperators($operator)){
					 				foreach($values as $queryValues){
					 					if(is_array($queryValues) && !empty($queryValues)){
					 						$condition .= " {$queryValues[0]} {$operator} ?";
							 				$valuesToCompare[$top++] = $queryValues[1];
							 			}
							 			else{
							 				if(!empty($queryValues)){
							 					$condition .= " {$queryValues}";
							 				}
							 			}
					 				}
						 		}
					 			else{
					 				if(!empty($values)){
					 					$condition .= " {$values}";
					 				}
					 			}
					 		}
					 		return $dbConnection->select($columns, $tables, $condition, $valuesToCompare);
					 	}
				 		return $dbConnection->select($columns, $tables);
					}
				}
			}
			return false;
		}
	}
?>