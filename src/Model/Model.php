<?php  
	abstract class Model implements ModelInterface{
		private $databaseName;
		private $tableName;

		public function modelConfig($modelConfig){
			if(!empty($modelConfig) && is_array($modelConfig)){
				if(
					(array_key_exists("databaseName", $modelConfig)) && 
					(array_key_exists("tableName", $modelConfig))
				){
					if(!empty($modelConfig["databaseName"]) && !empty($modelConfig["tableName"])){
						$this->databaseName = $modelConfig["databaseName"];
						$this->tableName = $modelConfig["tableName"];
					}
				}
			}
		}

		public function getTableName(){
			if(empty($this->tableName)){
				return str_replace("Model", "", get_class($this));
			}
			return $this->tableName;
		}

		public function getDatabaseName(){
			return $this->databaseName;
		}

		public function get(){
			return [
				"Db" => $this->getDatabaseName(),
				"Table" => $this->getTableName(),
				"query" => "SELECT * FROM {$this->getTableName()}"
			];
		}
	}
?>