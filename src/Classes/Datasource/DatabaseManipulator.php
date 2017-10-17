<?php  
	class DatabaseManipulator extends Connection{
		private static $connection;

		public function __construct($databaseType, $database){
			$connectionConfig = getDatabaseConfig($databaseType, $database);

			if(!empty($connectionConfig)){
				self::$connection = Connection::getInstance(
					$connectionConfig["dsn"], 
					$connectionConfig["user"], 
					$connectionConfig["password"]
				);
			}
		}

		/*
		 * O método select é usado para fazer buscas no banco de dados, 
		 * o método só funcionará, caso a conexão com o banco de dados seja estabelecida.
		 *
		 *  (string) columns, coluna(s) da(s) tabela(s) ou * para retornar os 
		 *  dados de todas as colunas da tabela.
		 *  (string) table, nome(s) da(s) tabela(s) onde os dados serão buscados.
		 *
		 * Os dois valores abaixo, são opcionais quando para a coluna for passado o valor *.
		 *  (string) condition, condição para a busca dos dados (opcional).
		 *  (array) conditionValues, valores a serem passados para a condição.
		 *
		 *   Exemplo: 
		 *	   condition: "where user=? and password=?";
		 *	   conditionValues: ["example", "123"];
		 */


		public function isOperator($operator){
			$operators = ["=", "+", "-", "*", "like", "not like", ">", "<", "<>", "!="];

			if(!empty($operator) && is_string($operator)){
				if(in_array(strtolower($operator), $operators)){
					return true;
				}
			}
			return false;
		}
		
		public function queryCreator($arrayQuery){
			if(!empty($arrayQuery) && is_array($arrayQuery)){


				foreach($arrayQuery as $operator => $query){
					if($this->isOperator($operator) && !empty($query) && is_array($query)){
						foreach($query as $column => $value){
							if(!$this->isOperator($column)){
								if(is_string($column)){

								}
							}
							debug($column);
						}
					}
				}



				/*return array_map(function($operator, $values){
					return $values;
					$column = key($values);

					if($this->isOperator($operator)){
						if(!$this->isOperator($column)){
							if(is_string($column)){
								return ["{$column} {$operator} :{$column}" => $values[$column]];
							}
							return $values[$column];
						}
					}
				}, 
				array_keys($arrayQuery), $arrayQuery);*/
			}
		}

		//public function query($arrayQuery){
			//$this->queryCreator($arrayQuery);

			/*$query = self::$connection->prepare(
				"SELECT * from cadastro where cod_cadastro = :cod_cadastro"
			);
			$query->bindValue(":cod_cadastro", 5012);
			$query->execute();
						
			return $query->fetchAll(PDO::FETCH_ASSOC);*/
		//}
		public function select($columns, $table, $condition = null, $conditionValues = null){
			if(!empty(self::$connection)){
				if(is_string($columns) && is_string($table)){
					if(empty($condition) && empty($conditionValues)){
						$query = self::$connection->prepare("SELECT {$columns} FROM {$table}");
						$query->execute();
						
						return $query->fetchAll(PDO::FETCH_ASSOC);
					}
					else{
						if(is_string($condition) && is_array($conditionValues)){
							$query = self::$connection->prepare(
								"SELECT {$columns} FROM {$table} {$condition}"
							);
							$query->execute($conditionValues);
						
							return $query->fetchAll(PDO::FETCH_ASSOC);
						}
						if(is_string($condition) && empty($conditionValues)){
							$query = self::$connection->prepare(
								"SELECT {$columns} FROM {$table} {$condition}"
							);
							$query->execute();
							
							return $query->fetchAll(PDO::FETCH_ASSOC);
						}
					}
				}
			}
			return false;
		}

		/*
		 * O método insert é usado para inserir dados no banco de dados, 
		 * o método só funcionará, caso a conexão com o banco de dados seja estabelecida.
		 *
		 * 	(string) table, nome da tabela onde os dados serão inseridos.
		 * 	(array) columns, colunas da tabela onde os dados serão inseridos.
		 * 	(array) values, valores a serem inseridos referentes às colunas da tabela.
		 */
		public function insert($table, $columns, $values){
			if(!empty(self::$connection)){
				if(is_string($table) && is_array($columns) && is_array($values)){
					for($i = 0; $i < sizeof($columns); $i++){
						$columnFormat .= $columns[$i];
						$column .= substr($columns[$i], 1);

						if($i < (sizeof($columns) - 1)){
							$columnFormat .= ", ";
							$column .= ", ";
						}
					}

					$query = "INSERT INTO {$table}({$column}) VALUES({$columnFormat})";
					$query = self::$connection->prepare($query);
					for($j = 0; $j < sizeof($columns); $j++){
						$query->bindParam($columns[$j], $values[$j], PDO::PARAM_STR);
					} 
					$query->execute();
					return true;
				}
			}
			return false;
		}

		/*public function delete($table, $condition, $values){
			if(!empty(self::$connection)){
				if(is_string($table) && is_string($condition) && is_array($values)){
					

					$query = "DELETE FROM {$table} {$condition}";
					$query = self::$connection->prepare($query);
					for($j = 0; $j < sizeof($columns); $j++){
						$query->bindParam($columns[$j], $values[$j], PDO::PARAM_STR);
					} 
					$query->execute();
					return true;
				}
			}
			return false;
		}*/
	}
?>