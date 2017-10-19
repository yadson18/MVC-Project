<?php  
	class ClienteTable extends Table{
		public function initialize(){
			parent::database("firebird", "sricash");

			$this->table("cadastro");
			$this->primaryKey("cod_cadastro");
			$this->belongsTo("Contrato", [
				"className" => "contrato",
				"foreignKey" => "contratante"
			]);
		}
	}