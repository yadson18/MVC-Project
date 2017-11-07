<?php  
	abstract class Table implements TableInterface{
		private $table;
		private $primaryKey;
		private $belongsTo;
		private $QueryBuilder;

		public function __construct(){
			$this->belongsTo = [];
		}

		public function getEntityName(){
			return str_replace("Table", "", get_class($this));
		}

		protected function database(string $databaseType, string $database){
			$this->QueryBuilder = new QueryBuilder($databaseType, $database, $this->getEntityName());
		}
		public function queryBuilder(){
			if(!empty($this->QueryBuilder)){
				return $this->QueryBuilder;
			}
			return false;
		}

		protected function belongsTo(string $fieldName, array $arrayConfig){
			$this->belongsTo[$fieldName] = $arrayConfig;
		}
		public function getBelongsTo(string $fieldName = null){
			if(!empty($this->belongsTo) && !empty($fieldName)){
				if(array_key_exists($fieldName, $this->belongsTo)){
					return $this->belongsTo[$fieldName];
				}
				return $this->belongsTo;
			}
			return false;
		}

		protected function table(string $table){
			if(!empty($table)){
				$this->table = $table;
			}
		}
		public function getTable(){
			if(!empty($this->table)){
				return $this->table;
			}
			return false;
		}

		protected function primaryKey(string $primaryKey){
			if(!empty($primaryKey)){
				$this->primaryKey = $primaryKey;
			}
		}
		public function getPrimaryKey(){
			if(!empty($this->primaryKey)){
				return $this->primaryKey;
			}
			return false;
		}
	}