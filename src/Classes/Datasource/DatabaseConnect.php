<?php  
	class DatabaseConnect extends Connection{
		private static $connection;

		public function __construct($connectionData){
			self::$connection = parent::__construct(
				$connectionData["dsn"], 
				$connectionData["user"], 
				$connectionData["password"]
			);
		}

		public function queryOperators($operator){
			$operators = ["=", "+", "-", "*", "like", "not like", ">", "<", "<>"];

			foreach($operators as $avaliableOperator){
				if(strtolower($operator) === $avaliableOperator){
					return true;
				}
			}
			return false;
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