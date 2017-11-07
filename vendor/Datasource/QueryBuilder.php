<?php  
	class QueryBuilder{
		private $DbManipulator;
		private $queryType;
		private $table;
		private $filters;
		private $condition;
		private $conditionValues;
		private $orderBy;
		private $returnType = "array";
		private $limit;

		public function __construct(string $databaseType, string $database, string $entityName){
			$this->DbManipulator = new DatabaseManipulator($databaseType, $database, $entityName);
		}

		protected function setTable(string $tableName){
			if(!empty($tableName)){
				$this->table = $tableName;

				return true;
			}
			return false;
		}

		protected function setOrderBy(array $columnsToOrder){
			if(!empty($columnsToOrder)){
				$order = "";

				foreach($columnsToOrder as $column => $orderType){
					if(is_string($column) && !is_array($orderType)){
						$order .= " {$column} {$orderType},";
					} 
				}

				if(!empty($order)){
					$this->orderBy = " ORDER BY".substr($order, 0, (strlen($order) - 1));

					return true;
				}
			}
			return false;
		}

		protected function setFilters(string $columnFilters){
			if(!empty($columnFilters)){
				$this->filters = $columnFilters;

				return true;
			}
			return false;
		}

		protected function setLimit(int $limitNumber){
			if(!empty($limitNumber)){
				$this->limit = " FIRST {$limitNumber}";

				return true;
			}
			return false;
		}

		protected function setReturnType(string $returnTypeData){
			$avaliableTypes = ["object", "array"];
			
			if(!empty($returnTypeData) && in_array($returnTypeData, $avaliableTypes)){
				$this->returnType = $returnTypeData;

				return $this;
			}
			return false;
		}

		protected function setCondition(array $queryCondition){
			if(!empty($queryCondition)){
				$condition = "";
				$values = [];

				foreach($queryCondition as $column => $value){
					if(is_string($column)){
						$condition .= " {$column} ?";
						$values[] = $value;
					}
					else{
						$condition .= " {$value}";
					}
				}

				if(!empty($condition)){
					if(!empty($values)){
						$this->conditionValues = $values;
					}
					$this->condition = " WHERE{$condition}";

					return true;
				}
				return false;
			}
		}

		protected function setQueryType(string $queryType){
			if(!empty($queryType)){
				$this->queryType = $queryType;

				return true;
			}
			return false;
		}


		public function find(string $tableName, string $columnFilters){
			if($this->setTable($tableName)){
				if($this->setFilters($columnFilters) && $this->setQueryType("select")){
					return $this;
				}
			}
			return false;
		}

		public function where(array $queryCondition){
			if($this->setCondition($queryCondition)){
				return $this;
			}
		}

		public function limit(int $limitNumber){
			if($this->setLimit($limitNumber)){
				return $this;
			}
			return false;
		}

		public function orderBy(array $columnsToOrder){
			if($this->setOrderBy($columnsToOrder)){
				return $this;
			}
			return false;
		}

		public function convertTo(string $returnTypeData){
			if($this->setReturnType($returnTypeData)){
				return $this;
			}
			return false;
		}

		public function getResult(){
			if($this->queryType === "select"){
				return $this->DbManipulator->select(
					$this->returnType,
					"SELECT{$this->limit} {$this->filters} FROM {$this->table}{$this->condition}{$this->orderBy}",
					$this->conditionValues
				);
			}
		}
	}