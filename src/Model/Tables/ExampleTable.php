<?php  
	class ExampleTable extends Table{
		public function initialize(){
			parent::database("database name", "database type");

			$this->table("example");
			$this->primaryKey("example_id");
			$this->belongsTo("", []);
		}
	}