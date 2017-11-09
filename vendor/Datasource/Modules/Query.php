<?php  
	class Query{
		private $table;
		private $condition;
		private $conditionValues;
		private static $queryType;

		public static function typeIs(string $queryType){
			if(self::$queryType === $queryType){
				return true;
			}
			return false;
		}
		public static function setType(string $queryType){
			if(!empty($queryType)){
				self::$queryType = $queryType;

				return true;
			}
			return false;
		}

		public function setTable(string $tableName){
			if(!empty($tableName)){
				$this->table = $tableName;

				return true;
			}
			return false;
		}
		public function getTable(){
			return $this->table;
		}

		public function setCondition(array $queryCondition){
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

		public function getCondition(){
			return $this->condition;
		}
		public function getConditionValues(){
			return $this->conditionValues;
		}
	}