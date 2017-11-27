<?php  
	namespace Model\Tables;

	class ExampleTable extends Table
	{
		public function initialize()
		{
			parent::database("firebird", "SRICASH");

			$this->table("CADASTRO");

			$this->primaryKeys("cod_cadastro");

			$this->belongsTo("", []);
		}

		public function defaultValidator(Validator $validator)
		{
			return $validator;
		}
	}