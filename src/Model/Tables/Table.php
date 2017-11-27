<?php
	namespace Model\Tables;

	use Model\Tables\Interfaces\TableInterface;
	use Simple\ORM\QueryBuilder;

	abstract class Table implements TableInterface{
		private $belongsTo = [];
		private $table;
		private $primaryKeys;
		private $QueryBuilder;

		public function getEntityName(){
			return str_replace(
				"Table", "", str_replace("Tables", "Entity", get_class($this))
			);
		}

		protected function database(string $databaseType, string $database){
			$this->QueryBuilder = new QueryBuilder($databaseType, $database, $this->getEntityName());
		}
		
		public function queryBuilder(){
			if (!empty($this->QueryBuilder)) {
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

		protected function primaryKeys(array $primaryKeys){
			if(!empty($primaryKeys)){
				$this->primaryKeys = $primaryKeys;
			}
		}
		public function getPrimaryKeys(){
			if(!empty($this->primaryKeys)){
				return $this->primaryKeys;
			}
			return false;
		}
	}