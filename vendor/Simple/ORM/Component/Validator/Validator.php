<?php 
	namespace Simple\ORM\Component\Validator;

	class Validator
	{
		private $tableAttributes;
		
		public function __construct(array $tableAttributes)
		{
			$this->tableAttributes = $tableAttributes;
		}

		public function isValid(string $column, $value){
			if(!empty($column) && isset($this->tableAttributes[$column])){
				$attribute = $this->tableAttributes[$column];

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
		}

		protected function validateSizeValue(string $column, $value){
			if(isset($this->tableAttributes[$column]) && !empty($value)){
				if($this->tableAttributes[$column]["size"] >= strlen(trim($value))){
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