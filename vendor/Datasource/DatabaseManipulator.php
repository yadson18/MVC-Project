<?php  
	class DatabaseManipulator{
		private $Connection;
		private $entityName;
		private $table;
		private $filterColumns;
		private $condition;
		private $columnsAndvalues;
		private $returnType;

		public function __construct(string $databaseType, string $database, string $entity){
			$this->Error = new ErrorHandling("DatabaseManipulator");

			$connectionConfig = getDatabaseConfig($databaseType, $database);
			if(!empty($connectionConfig)){
				$this->entityName = $entity;
				$this->Connection = Connection::getInstance(
					$connectionConfig["dsn"], 
					$connectionConfig["user"], 
					$connectionConfig["password"]
				);
			}
		}

		protected function getModelName(){
			if(!empty($this->entityName)){
				return $this->entityName;
			}
			return false;
		}

		protected function setFilterColumns(string $filterColumns){
			if(!empty($filterColumns)){
				$this->filterColumns = $filterColumns;
				return true;
			}
			return false;
		}
		protected function getFilterColumns(){
			if(!empty($this->filterColumns)){
				return $this->filterColumns;
			}
			return false;
		}

		protected function setCondition(string $condition){
			if(!empty($condition)){
				$this->condition = $condition;
				return true;
			}
			return false;
		}
		protected function getCondition(){
			if(!empty($this->condition)){
				return $this->condition;
			}
			return false;
		}

		protected function setColumnsAndvalues(array $columnsAndvalues){
			if(!empty($columnsAndvalues)){
				$this->columnsAndvalues = $columnsAndvalues;
				return true;
			}
			return false;
		}
		protected function getColumnsAndvalues(){
			if(!empty($this->columnsAndvalues)){
				return $this->columnsAndvalues;
			}
			return false;
		}

		protected function setTable(string $table){
			if(!empty($table)){
				$this->table = $table;
				return true;
			}
			return false;
		}
		protected function getTable(){
			if(!empty($this->table)){
				return $this->table;
			}
			return false;
		}

		protected function setReturnType(string $returnType){
			$avaliableTypes = ["object"];

			if(!empty($returnType) && in_array($returnType, $avaliableTypes)){
				$this->returnType = $returnType;
				return true;
			}
			return false;
		}
		protected function getReturnType(){
			if(!empty($this->returnType)){
				return $this->returnType;
			}
			return false;
		}

		public function toObject(){
			if($this->setReturnType("object")){
				return $this;
			}
			return false;
		}

		public function find(string $table, string $columns){
			if($this->setTable($table) && $this->setFilterColumns($columns)){
				return $this;
			}
			return false;
		}

		public function where(array $arrayQuery){
			if(!empty($arrayQuery)){
				$stringfyColumns = "";
				$columnsAndValues = [];

				foreach($arrayQuery as $column => $value){
					if(is_string($column)){
						$columnName = substr($column, 0, strpos($column, " ")); 
						
						$stringfyColumns .= " {$column} ?";
						$columnsAndValues[] = $value;
					}
					else{
						$stringfyColumns .= " {$value}";
					}
				}

				if(
					($this->setCondition($stringfyColumns) && $this->setColumnsAndvalues($columnsAndValues)) ||
					($this->setCondition($stringfyColumns) && !$this->setColumnsAndvalues($columnsAndValues))
				){
					return $this;
				}
			}
			return false;
		}

		public function limit($limitNumber){
			if(!empty($limitNumber)){
				if(is_string($limitNumber) && (strtolower($limitNumber) === "max")){
					return $this->select("");
				}
				if(!is_string($limitNumber) && is_numeric($limitNumber)){
					return $this->select("FIRST {$limitNumber} ");
				}
			}
			return false;
		}

		/*
		 * O método select é usado para fazer buscas no banco de dados, 
		 * o método só funcionará, caso a conexão com o banco de dados seja estabelecida.
		 *
		 *  (int) limit, quantidade de dados que o metodo retornará.
		 */
		protected function select($limit){
			if(!empty($this->Connection)){
				if($this->getTable() && $this->getFilterColumns()){
					if($this->getCondition() && $this->getColumnsAndvalues()){
						try{
							$query = $this->Connection->prepare(
								"SELECT {$limit}{$this->getFilterColumns()} 
								 FROM {$this->getTable()} 
								 WHERE{$this->getCondition()}"
							);
						}
						catch(Exception $Exception){
							$this->Error->stopExecution(
								$Exception->getCode(), $Exception->getMessage(), 168
							);
						}

						foreach($this->getColumnsAndvalues() as $column => $value){
							$query->bindValue(++$column, $value);
						}
					}
					else if($this->getCondition() && !$this->getColumnsAndvalues()){
						try{
							$query = $this->Connection->prepare(
								"SELECT {$limit}{$this->getFilterColumns()} 
								 FROM {$this->getTable()} 
								 WHERE{$this->getCondition()}"
							);
						}
						catch(Exception $Exception){
							$this->Error->stopExecution(
								$Exception->getCode(), $Exception->getMessage(), 186
							);
						}
					}
					else if(!$this->getCondition() && !$this->getColumnsAndvalues()){
						try{
							$query = $this->Connection->prepare(
								"SELECT {$limit}{$this->getFilterColumns()} FROM {$this->getTable()}"
							);
						}
						catch(Exception $Exception){
							$this->Error->stopExecution(
								$Exception->getCode(), $Exception->getMessage(), 200
							);
						}
					}

					if(!empty($query) && isInstanceOf($query, "PDOStatement")){
						$query->execute();	

						if($this->getReturnType()){
							if($this->getReturnType() === "object"){
								$query->setFetchMode(PDO::FETCH_CLASS, $this->getModelName());

								try{
									return $query->fetch();
								}
								catch(Exception $Exception){
									$this->Error->stopExecution(
										$Exception->getCode(), $Exception->getMessage(), 228
									);
								}
							}
						}
						$query->setFetchMode(PDO::FETCH_ASSOC);

						try{
							return $query->fetchAll();
						}
						catch(Exception $Exception){
							$this->Error->stopExecution(
								$Exception->getCode(), $Exception->getMessage(), 240
							);
						}
					}
				}
			}
			$this->Error->stopExecution(
				"1", "Connection with database has not established.", 164
			);
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