<?php 
	namespace Simple\ORM\Component;

	class Validator
	{
		private $sqlAndPhpTypes = [
			"int64" => "int", "char" => "string", "varchar" => "string", "date" => "string",
			"integer" => "int", "smallint" => "int", "double" => "double", "float" => "float"
		];
		private $data;
		

		public function data(array $tableColumnInfo){
			if(!empty($tableColumnInfo)){
				$this->data = $tableColumnInfo;

				return $this;
			}
			return false;
		}

		public function isValid($value){
			if(isset($this->data["type"]) && isset($this->data["null"]) && isset($this->data["size"])){
				$this->data["type"] = strtolower($this->data["type"]);

				if(array_key_exists($this->data["type"], $this->sqlAndPhpTypes)){
					$function = "return is_{$this->sqlAndPhpTypes[$this->data['type']]}(\$value);";
					
					if(eval($function)){
						debug(gettype($this->data["type"]))
						debug("ok"); echo "<br>";
					}
				}
			}
		}
	}