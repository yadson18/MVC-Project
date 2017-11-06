<?php  
	abstract class Entity{
		private static $Table;

		public function __construct(){
			self::$Table = $this->loadTable(get_class($this));
		}

		protected function loadTable(string $entityName){
			if(!empty($entityName) && class_exists("{$entityName}Table")){
				$tableToLoad = $entityName."Table";
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
				return self::$Table->getDBManipulator()
					->find(self::$Table->getTable(), $columns);
			}
			return false;
		}

		public function get($key, array $contain = null){
			if($this->tableHasLoaded()){
				if(is_string($key) && strtolower($key) === "all" && empty($contain)){
					return self::$Table->getDBManipulator()
						->find(self::$Table->getTable(), "*")
						->limit("max");
				}
				else if(self::$Table->getPrimaryKey() && !empty($key) && !is_array($key)){
					return self::$Table->getDBManipulator()
						->find(self::$Table->getTable(), "*")
						->where([self::$Table->getPrimaryKey()." =" => $key])
						->toObject()
						->limit(1);
				}
			}
			return false;
		}
	}