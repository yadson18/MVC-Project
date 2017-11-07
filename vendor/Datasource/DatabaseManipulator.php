<?php  
	class DatabaseManipulator{
		private $Connection;
		private $entityName;

		public function __construct(string $databaseType, string $database, string $entityName){
			$this->Config = Configurator::getInstance();
			
			if(!empty($databaseType) && !empty($database) && !empty($entityName)){
				$this->Error = new ErrorHandling("DatabaseManipulator");
				$this->Connection = Connection::getInstance(
					$databaseType, $this->Config->get("Databases", $database)
				);
				
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
		}


		/*
		 * O método insert é usado para inserir dados no banco de dados, 
		 * o método só funcionará, caso a conexão com o banco de dados seja estabelecida.
		 *
		 * 	(string) table, nome da tabela onde os dados serão inseridos.
		 * 	(array) columns, colunas da tabela onde os dados serão inseridos.
		 * 	(array) values, valores a serem inseridos referentes às colunas da tabela.
		 */
		/*public function insert($table, $columns, $values){
			if(!empty(self::$connection)){
				if(is_string($table) && is_array($columns) && is_array($values)){
					for($i = 0; $i < sizeof($columns); $i++){
						$columnFormat .= $columns[$i];
						$column .= substr($columns[$i], 1);

						if($i < (sizeof($columns) - 1)){
							$columnFormat .= ", ";
							$column .= ", ";
						}
					}

					$query = "INSERT INTO {$table}({$column}) VALUES({$columnFormat})";
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