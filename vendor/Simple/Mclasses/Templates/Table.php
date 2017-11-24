<?php  
	namespace Model\Tables;

	class %table_name%Table extends Table{
		protected $tableAttributes = [%table_attributes%
		];

		public function initialize(){
			parent::database("%db_type%", "%db_name%");

			$this->table("%table%");
			$this->primaryKey("%primary_key%");
			$this->belongsTo("", []);
		}
	}