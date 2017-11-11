<?php  
	abstract class Entity{
		private static $Table;

		public function __construct(){
			self::$Table = $this->loadSelfTable(get_class($this));
		}

		protected function loadSelfTable(string $entityName){
			$tableToLoad = "{$entityName}Table";
			
			if(!empty($entityName) && class_exists($tableToLoad)){
				$tableToLoad = new $tableToLoad();

				if(!empty($tableToLoad) && is_object($tableToLoad) && is_callable([$tableToLoad, "initialize"])){
					$tableToLoad->initialize();
					return $tableToLoad;
				}
			}
			return false;
		}

		public function tableHasLoaded(){
			if(!empty(self::$Table) && is_object(self::$Table)){
				return true;
			}
			return false;
		}

		public function find(string $columns){
			if($this->tableHasLoaded()){
				return self::$Table->queryBuilder()
					->find($columns)
					->from(self::$Table->getTable());
			}
			return false;
		}

		public function get($key, array $contain = null){
			if($this->tableHasLoaded()){
				if($key === "all" && empty($contain)){
					return self::$Table->queryBuilder()
						->find("*")
						->from(self::$Table->getTable())
						->getResult();
				}
				else if(self::$Table->getPrimaryKey() && !empty($key) && !is_array($key)){
					return self::$Table->queryBuilder()
						->find("*")
						->from(self::$Table->getTable())
						->where([self::$Table->getPrimaryKey()." =" => $key])
						->convertTo("object")
						->limit(1)
						->getResult();
				}
			}
			return false;
		}

		public function save($objectToSave){
			if(!empty($objectToSave) && isInstanceOf($objectToSave, get_class($this))){
				return self::$Table->queryBuilder()
					->insert(get_object_vars($objectToSave))
					->into(self::$Table->getTable())
					->getResult();
			}
			return false;
		}

		public function delete($key){
			if(!empty($key)){
				if($key === "all"){
					return self::$Table->queryBuilder()
						->delete()
						->from(self::$Table->getTable());
				}
				else if(self::$Table->getPrimaryKey() && !empty($key) && !is_array($key)){
					return self::$Table->queryBuilder()
						->delete()
						->from(self::$Table->getTable())
						->where([self::$Table->getPrimaryKey()." =" => $key])
						->getResult();
				}
			}
			return false;
		}
	}