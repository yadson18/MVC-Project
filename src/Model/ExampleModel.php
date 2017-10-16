<?php  
	class ExampleModel extends Model{
		public function __construct(){
			$this->modelConfig([
				"databaseName" => "exampleBase",
				"tableName" => "example_model"
			]);
		}

		public function sayHello(){
			echo "Hello...";
		}
	}
?>