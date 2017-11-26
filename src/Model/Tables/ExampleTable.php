<?php  
	namespace Model\Tables;

	class ExampleTable extends Table{
		protected $tableAttributes = [];

		public function initialize(){
			parent::database("firebird", "SRICASH");

			$this->table("CADASTRO");
			$this->primaryKey("cod_cadastro");
			$this->belongsTo("", []);
		}
	}