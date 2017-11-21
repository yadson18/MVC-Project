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

		public function isValid(array $columnsAndValues){
			if(!empty($columnsAndValues)){
				foreach ($columnsAndValues as $column => $value) {
					if (isset($this->tableValidAttributes[$column])) {
						$attribute = $this->tableValidAttributes[$column];

						if(isset($attribute["type"]) && isset($attribute["null"]) && isset($attribute["size"])){
							$attribute["type"] = strtolower($attribute["type"]);

							$function = "return is_{$attribute['type']}(\$value);";

							if (!$this->canBeNull($attribute["null"])) {
								if ($this->isNull($value)) {
									return false;
								}
								else if (!eval($function) || !$this->validateSizeValue($column, $value)) {
									return false;
								}
							}
							else if ($this->canBeNull($attribute["null"])) {
								if (
									!$this->isNull($value) && !eval($function) || 
									!$this->validateSizeValue($column, $value)
								) {
									return false;
								}
							}
						}
					}
				}
				return true;
			}
			return false;
		}

		protected function isNull($value)
		{
			if(is_string($value) || is_null($value)){
				if(empty($value) || is_null($value) || !isset($value)){
					return true;
				}
			}
			return false;
		}

		protected function validateSizeValue(string $column, $value){
			if(isset($this->tableValidAttributes[$column])){
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