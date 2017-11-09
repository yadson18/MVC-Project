<?php  
	class QueryBuilder{
		private $DbManipulator;
		private $Select;

		private $insertColumns;
		private $formatedInsertColumns;
		private $insertColumnsAndValues;

		public function __construct(string $databaseType, string $database, string $entityName){
			$this->DbManipulator = new DatabaseManipulator($databaseType, $database, $entityName);

			$this->Select = new Select();
		}

		protected function setInsertQuery(array $dataToInsert){
			if(!empty($dataToInsert)){
				$columns = sprintf(",%s", implode(",", array_keys($dataToInsert)));
				$formatedColumns = sprintf(",:%s", implode(",:", array_keys($dataToInsert)));

				if(!empty($columns) && !empty($formatedColumns)){
					$this->insertColumns = substr($columns, 1);
					$this->formatedInsertColumns = substr($formatedColumns, 1);
					$this->insertColumnsAndValues = $dataToInsert;

					return true;
				}
				return false;
			}
		}

		public function find(string $columnFilters){
			if($this->Select->setFilters($columnFilters) && Query::setType("select")){
				return $this;
			}
			return false;
		}

		public function from(string $tableName){
			if($this->Select->setTable($tableName)){
				return $this;
			}
			return false;
		}

		public function where(array $queryCondition){
			if($this->Select->setCondition($queryCondition)){
				return $this;
			}
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
			if($this->setInsertQuery($dataToInsert) && $this->setQueryType("insert")){
				return $this;
			}
			return false;
		}

		public function getResult(){
			if(Query::typeIs("select")){
				$returnType = $this->Select->getReturnType();
				$conditionValues = $this->Select->getConditionValues();
				$query = "SELECT{$this->Select->getLimit()} {$this->Select->getFilters()} 
						  FROM {$this->Select->getTable()}
						  {$this->Select->getCondition()}{$this->Select->getOrderBy()}";

				return $this->DbManipulator->select($returnType, $query, $conditionValues);
			}
			else if(Query::typeIs("insert")){
				return $this->DbManipulator->insert(
					"INSERT INTO {$this->table}({$this->insertColumns}) VALUES({$this->formatedInsertColumns})",
					$this->insertColumnsAndValues
				);
			}
		}
	}