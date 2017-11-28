<?php  
	namespace Model\Tables;

	class ExampleTable extends Table
	{
		public function initialize(){}

		public function defaultValidator(Validator $validator)
		{
			return $validator;
		}
	}