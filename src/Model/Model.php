<?php  
	abstract class Model implements ModelInterface{
		private $tableName;
		private $DbManipulator;

		protected function __construct($databaseType, $database){
			$this->DBManipulator = new DatabaseManipulator($databaseType, $database);
		}

		public function setTableName($tableName){
			if(!empty($tableName) && is_string($tableName)){
				$this->tableName = $tableName;
			}
		}

		public function getTableName(){
			if(empty($this->tableName)){
				return str_replace("Model", "", get_class($this));
			}
			return $this->tableName;
		}

		public function get($key){
			return $this->DBManipulator->queryCreator([
				"=" => [
					"cod_cadastro" => 512, "and",
					"idade" => 18
				]
			]);

			/*if(strtolower($key) === "all"){
				$column = "*";
			}
			
			return $this->DBManipulator->select($column, $this->getTableName());*/
		}
	}