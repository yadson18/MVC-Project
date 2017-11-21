<?php 
	namespace Simple\ORM\Component\Validator;

	class Validator
	{
		private $tableValidAttributes;

		public function initialize(array $tableValidAttributes){
			if(!empty($tableValidAttributes)){
				$this->tableValidAttributes = $tableValidAttributes;
			}
		}

		public function isValid(string $column, $value){
			if(!empty($column) && isset($this->tableValidAttributes[$column])){
				$attribute = $this->tableValidAttributes[$column];

				if(isset($attribute["type"]) && isset($attribute["null"]) && isset($attribute["size"])){
					$attribute["type"] = strtolower($attribute["type"]);

					$function = "return is_{$attribute['type']}(\$value);";

					if(is_null($value) || empty($value) && $this->canBeNull($attribute["null"])){
						return true;
					}
					else if(eval($function) && $this->validateSizeValue($column, $value)){
						return true;
					}
					return false;
				}
			}
			return false;
		}

		protected function validateSizeValue(string $column, $value){
			if(isset($this->tableValidAttributes[$column]) && !empty($value)){
				if($this->tableValidAttributes[$column]["size"] >= strlen(trim($value))){
					return true;
				}
			}
			return false;
		}

		protected function canBeNull(string $null){
			if(!empty($null)){
				if($null === "y"){
					return true;
				}
			}
			return false;
		}
	}