<?php  
	class DatabaseManipulator{
		private $Connection;
		private $entityName;

		public function __construct(string $databaseType, string $database, string $entityName){
			if(!empty($databaseType) && !empty($database) && !empty($entityName)){
				$dbConfigs = Configurator::getInstance()->get("Databases", $database);
				
				$this->Error = new ErrorHandling("DatabaseManipulator");
				$this->Connection = Connection::getInstance($databaseType, $dbConfigs);
				$this->entityName = $entityName;
			}

		}

		/*
		 * O método select é usado para fazer buscas no banco de dados, 
		 * o método só funcionará, caso a conexão com o banco de dados seja estabelecida.
		 */

		public function select(string $returnType, string $query, array $values = null){
			if(!empty($this->Connection)){
				try{
					$dbQuery = $this->Connection->prepare($query);

					if(!empty($values)){
						foreach($values as $column => $value){
							$dbQuery->bindValue(++$column, $value);
						}
					}

					if($returnType === "object"){
						$dbQuery->setFetchMode(PDO::FETCH_CLASS, $this->entityName);
					}
					else if($returnType === "array"){
						$dbQuery->setFetchMode(PDO::FETCH_ASSOC);
					}

					$dbQuery->execute();
					return $dbQuery->fetchAll();
				}
				catch(Exception $Exception){
					$this->Error->stopExecution(
						$Exception->getCode(), $Exception->getMessage(), 30
					);
				}
			}
			$this->Error->stopExecution(
				1, "Connection with database cannot be established.", 25
			);
		}


		/*
		 * O método insert é usado para inserir dados no banco de dados, 
		 * o método só funcionará, caso a conexão com o banco de dados seja estabelecida.
		 */
		public function insert(string $query, array $columnsAndValues){
			if(!empty($this->Connection)){
				try{
					$dbQuery = $this->Connection->prepare($query);

					foreach($columnsAndValues as $column => $value){
						$dbQuery->bindValue(":{$column}", $value);
					}

					$dbQuery->execute();
					return $dbQuery->rowCount();
				}
				catch(Exception $Exception){
					$this->Error->stopExecution(
						$Exception->getCode(), $Exception->getMessage(),68
					);
				}
			}
			$this->Error->stopExecution(
				1, "Connection with database cannot be established.", 62
			);
		}

		/*public function delete($table, $condition, $values){
			if(!empty(self::$connection)){
				if(is_string($table) && is_string($condition) && is_array($values)){
					

					$query = "DELETE FROM {$table} {$condition}";
					$query = self::$connection->prepare($query);
					for($j = 0; $j < sizeof($columns); $j++){
						$query->bindParam($columns[$j], $values[$j], PDO::PARAM_STR);
					} 
					$query->execute();
					return true;
				}
			}
			return false;
		}*/
	}