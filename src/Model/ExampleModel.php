<?php  
	class ExampleModel extends Model{
		public function __construct(){
			parent::__construct("firebird", "sricash");
			$this->setTableName("cadastro");
		}

		public function sayHello(){
			echo "Hello...";
		}
	}
?>