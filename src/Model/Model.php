<?php  
	abstract class Model implements ModelInterface{
		private $tableName;
		private $tablePrimaryKey;
		private $DbManipulator;

		protected function __construct($databaseType, $database){
			$this->DBManipulator = new DatabaseManipulator($databaseType, $database, get_class($this));
		}

		protected function setTablePrimaryKey($columnName){
			if(!empty($columnName) && is_string($columnName)){
				$this->tablePrimaryKey = $columnName;
			}
		}

		protected function getTablePrimaryKey(){
			if(!empty($this->tablePrimaryKey)){
				return $this->tablePrimaryKey;
			}
			return false;
		}

		protected function setTableName($tableName){
			if(!empty($tableName) && is_string($tableName)){
				$this->tableName = $tableName;
			}
		}

		protected function getTableName(){
			if(empty($this->tableName)){
				return str_replace("Model", "", get_class($this));
			}
			return $this->tableName;
		}

		public function find($columns){
			return $this->DBManipulator->find($this->getTableName(), $columns);
		}

		public function get($key){
			if(strtolower($key) === "all"){
				return $this->DBManipulator->find($this->getTableName(), "*")->limit("max");
			}
			else if($this->getTablePrimaryKey()){
				return $this->DBManipulator->find($this->getTableName(), "*")
					->where(["{$this->getTablePrimaryKey()} =" => $key])
					->limit("max");
			}
			return false;
		}
	}