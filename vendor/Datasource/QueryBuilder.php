<?php  
	class QueryBuilder{
		private $Connection;
		private $Select;
		private $Insert;
		private $Delete;

		public function __construct(string $databaseType, string $database, string $entityName){
			//$this->Error = new ErrorHandling("DatabaseManipulator");

			$this->Connection = Connection::getInstance(
				$databaseType, Configurator::getInstance()->get("Databases", $database)
			);

			Query::currentEntity($entityName);
			$this->Select = new Select();
			$this->Insert = new Insert();
			$this->Delete = new Delete();
		}

		public function find(string $columnFilters){
			if($this->Select->setFilters($columnFilters) && Query::setType("select")){
				return $this;
			}
			return false;
		}

		public function from(string $tableName){
			if(
				(Query::typeIs("select") && $this->Select->setTable($tableName)) ||
				(Query::typeIs("delete") && $this->Delete->setTable($tableName))
			){
				return $this;
			}
			return false;
		}

		public function where(array $whereCondition){
			if(
				(Query::typeIs("select") && $this->Select->setCondition($whereCondition)) ||
				(Query::typeIs("delete") && $this->Delete->setCondition($whereCondition))
			){
				return $this;
			}
			return false;
		}
		
		public function orderBy(array $columnsToOrder){
			if($this->Select->setOrderBy($columnsToOrder) && Query::typeIs("select")){
				return $this;
			}
			return false;
		}

		public function convertTo(string $returnTypeData){
			if($this->Select->setReturnType($returnTypeData) && Query::typeIs("select")){
				return $this;
			}
			return false;
		}

		public function limit(int $limitNumber){
			if($this->Select->setLimit($limitNumber) && Query::typeIs("select")){
				return $this;
			}
			return false;
		}

		public function insert(array $dataToInsert){
			if($this->Insert->setInsertQuery($dataToInsert) && Query::setType("insert")){
				return $this;
			}
			return false;
		}

		public function into(string $tableName){
			if($this->Insert->setTable($tableName) && Query::setType("insert")){
				return $this;
			}
			return false;
		}

		public function delete(){
			if(Query::setType("delete")){
				return $this;
			}
			return false;
		}

		public function getResult(){
			if(Query::typeIs("select")){
				return $this->Select->getResult($this->Connection);
			}
			else if(Query::typeIs("insert")){
				return $this->Insert->getResult($this->Connection);
			}
			else if(Query::typeIs("delete")){
				return $this->Delete->getResult($this->Connection);
			}
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

