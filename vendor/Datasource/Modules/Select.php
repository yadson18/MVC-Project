<?php 
	class Select extends Query{
		private $returnType = "array";
		private $filters;
		private $orderBy;
		private $limit;

		public function setOrderBy(array $columnsToOrder){
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
		public function getOrderBy(){
			return $this->orderBy;
		}

		public function setFilters(string $columnFilters){
			if(!empty($columnFilters)){
				$this->filters = $columnFilters;

				return true;
			}
			return false;
		}
		public function getFilters(){
			return $this->filters;
		}

		public function setLimit(int $limitNumber){
			if(!empty($limitNumber)){
				$this->limit = " FIRST {$limitNumber}";

				return true;
			}
			return false;
		}
		public function getLimit(){
			return $this->limit;
		}

		public function setReturnType(string $returnTypeData){
			$avaliableTypes = ["object", "array"];
			
			if(!empty($returnTypeData) && in_array($returnTypeData, $avaliableTypes)){
				$this->returnType = $returnTypeData;

				return $this;
			}
			return false;
		}
		public function getReturnType(){
			return $this->returnType;
		}
	}