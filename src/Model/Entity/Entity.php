<?php  
	namespace Model\Entity;

	abstract class Entity{
		private static $Table;

		public function __construct(){
			self::$Table = $this->loadSelfTable(get_class($this));
		}

		protected function loadSelfTable(string $entityName){
			$Table = str_replace("Entity", "Tables", "{$entityName}Table");

			if(class_exists($Table)){
				$TableToLoad = new $Table;

				if(is_object($TableToLoad) && is_callable([$TableToLoad, "initialize"])){
					$TableToLoad->initialize();
					return $TableToLoad;
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

		public function save(){
			if(!empty($this)){
				return self::$Table->queryBuilder()
					->insert(get_object_vars($this))
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