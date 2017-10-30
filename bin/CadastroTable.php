<?php 
	class CadastroTable extends Table{
 		private $attributes = [
 			'empresa' => [ 'null' => 'y', 'size' => 4, 'type' => 'integer'],
 			'cod_cadastro' => [ 'null' => 'y', 'size' => 4, 'type' => 'integer'],
 			'razao' => [ 'null' => 'n', 'size' => 60, 'type' => 'varchar'],
 			'fantasia' => [ 'null' => 'n', 'size' => 40, 'type' => 'varchar'],
 			'cnpj' => [ 'null' => 'n', 'size' => 20, 'type' => 'varchar'],
 			'tipo' => [ 'null' => 'n', 'size' => 1, 'type' => 'varchar'],
 			'estadual' => [ 'null' => 'n', 'size' => 20, 'type' => 'varchar'],
 			'municipal' => [ 'null' => 'n', 'size' => 20, 'type' => 'varchar'],
 			'cae' => [ 'null' => 'n', 'size' => 10, 'type' => 'varchar'],
 			'endereco' => [ 'null' => 'n', 'size' => 40, 'type' => 'varchar'],
 			'bairro' => [ 'null' => 'n', 'size' => 30, 'type' => 'varchar'],
 			'cep' => [ 'null' => 'n', 'size' => 10, 'type' => 'varchar'],
 			'cidade' => [ 'null' => 'n', 'size' => 40, 'type' => 'varchar'],
 			'estado' => [ 'null' => 'n', 'size' => 20, 'type' => 'varchar'],
 			'telefone' => [ 'null' => 'n', 'size' => 20, 'type' => 'varchar'],
 			'fax' => [ 'null' => 'n', 'size' => 20, 'type' => 'varchar'],
 			'celular' => [ 'null' => 'n', 'size' => 20, 'type' => 'varchar'],
 			'contato' => [ 'null' => 'n', 'size' => 40, 'type' => 'varchar'],
 			'endcob' => [ 'null' => 'n', 'size' => 40, 'type' => 'varchar'],
 			'bairrocob' => [ 'null' => 'n', 'size' => 30, 'type' => 'varchar'],
 			'cepcob' => [ 'null' => 'n', 'size' => 10, 'type' => 'varchar'],
 			'cidadecob' => [ 'null' => 'n', 'size' => 40, 'type' => 'varchar'],
 			'estadocob' => [ 'null' => 'n', 'size' => 20, 'type' => 'varchar'],
 			'obs' => [ 'null' => 'n', 'size' => 1000, 'type' => 'varchar'],
 			'atividade' => [ 'null' => 'n', 'size' => 4, 'type' => 'integer'],
 			'correspondencia' => [ 'null' => 'n', 'size' => 1, 'type' => 'varchar'],
 			'tributacao' => [ 'null' => 'n', 'size' => 1, 'type' => 'varchar'],
 			'comissao' => [ 'null' => 'n', 'size' => 8, 'type' => 'double'],
 			'vendedor' => [ 'null' => 'n', 'size' => 4, 'type' => 'integer'],
 			'registro' => [ 'null' => 'n', 'size' => 1, 'type' => 'varchar'],
 			'deslocamento' => [ 'null' => 'n', 'size' => 8, 'type' => 'double'],
 			'ativo' => [ 'null' => 'n', 'size' => 1, 'type' => 'varchar'],
 			'multdistancia' => [ 'null' => 'n', 'size' => 8, 'type' => 'int64'],
 			'multatividade' => [ 'null' => 'n', 'size' => 4, 'type' => 'integer'],
 			'cadastrado_por' => [ 'null' => 'n', 'size' => 2, 'type' => 'smallint'],
 			'cadastrado_em' => [ 'null' => 'n', 'size' => 4, 'type' => 'date'],
 			'alterado_por' => [ 'null' => 'n', 'size' => 2, 'type' => 'smallint'],
 			'alterado_em' => [ 'null' => 'n', 'size' => 4, 'type' => 'date'],
 			'area' => [ 'null' => 'n', 'size' => 1, 'type' => 'varchar'],
 			'limite' => [ 'null' => 'n', 'size' => 8, 'type' => 'int64'],
 			'ultimo_venc' => [ 'null' => 'n', 'size' => 4, 'type' => 'date'],
 			'atual_venc' => [ 'null' => 'n', 'size' => 4, 'type' => 'date'],
 			'prazo' => [ 'null' => 'n', 'size' => 4, 'type' => 'integer'],
 			'tipo_fatura' => [ 'null' => 'n', 'size' => 10, 'type' => 'varchar'],
 			'datanasc' => [ 'null' => 'n', 'size' => 5, 'type' => 'varchar'],
 			'dia_fatuta' => [ 'null' => 'n', 'size' => 2, 'type' => 'varchar'],
 			'venc_cartao' => [ 'null' => 'n', 'size' => 4, 'type' => 'date'],
 			'cartao_proprio' => [ 'null' => 'n', 'size' => 1, 'type' => 'varchar'],
 			'senhacred' => [ 'null' => 'n', 'size' => 12, 'type' => 'varchar'],
 			'nrend1' => [ 'null' => 'n', 'size' => 12, 'type' => 'varchar'],
 			'nrend2' => [ 'null' => 'n', 'size' => 12, 'type' => 'varchar'],
 			'e_mail' => [ 'null' => 'n', 'size' => 100, 'type' => 'varchar'],
 			'cod_reg_trib' => [ 'null' => 'y', 'size' => 1, 'type' => 'varchar'],
 			'tipocad' => [ 'null' => 'y', 'size' => 1, 'type' => 'varchar'],
 			'st_liminar' => [ 'null' => 'y', 'size' => 1, 'type' => 'varchar'],
 			'complementar' => [ 'null' => 'n', 'size' => 40, 'type' => 'varchar'],
 			'tabela_preco' => [ 'null' => 'y', 'size' => 4, 'type' => 'integer'],
 			'id_convenio' => [ 'null' => 'n', 'size' => 4, 'type' => 'integer'],
 			'nr_convenio' => [ 'null' => 'n', 'size' => 100, 'type' => 'varchar'],
 			'cod_ctardz' => [ 'null' => 'n', 'size' => 4, 'type' => 'integer'],
 			'dia_corte' => [ 'null' => 'y', 'size' => 4, 'type' => 'integer'],
 			'dia_vencimento' => [ 'null' => 'y', 'size' => 4, 'type' => 'integer'],
 			'protestar' => [ 'null' => 'n', 'size' => 1, 'type' => 'varchar'],
 			'dias_protestar' => [ 'null' => 'n', 'size' => 4, 'type' => 'integer'],
 			'cpais' => [ 'null' => 'y', 'size' => 4, 'type' => 'varchar'],
 			'trilha1' => [ 'null' => 'n', 'size' => 20, 'type' => 'varchar'],
 			'trilha2' => [ 'null' => 'n', 'size' => 20, 'type' => 'varchar'],
 			'trilha3' => [ 'null' => 'n', 'size' => 20, 'type' => 'varchar']
		];
	}


	public function initialize(){
		parent::database('firebird', 'SRICASH');

		$this->table('CADASTRO');
		$this->primaryKey('cod_cadastro');
		$this->belongsTo([]);
	}
}
