<?php  
	/* 
	 * A classe Connection, serve para conectar-se a vários tipos de bancos de dados 
	 * através do PDO, tais como MySql, Firebird, PostgreSQL...
	 * Para a lista completa de bancos de dados suportados, consulte o manual do PHP.
	 */
	abstract class Connection{
		private static $connection;

		/*
		 * Para o construtor da classe devem ser passados,
		 *  (string) dsn, parâmetros de conexão,
		 *  (string) user, usuário,
		 *  (string) password, senha do usuário.
		 */
		public function __construct($dsn, $user, $password){
			try {
				self::$connection = new PDO($dsn, $user, $password);
			}
			catch (PDOException $e) {
				self::$connection = null;
			}
		}

		/*
		 * Este método retorna uma instância da classe PDO caso a conexão com o
		 * banco de dados seja estabelecida, caso contrário, retornará false.
		 */
		public function getConnection(){
			if(!is_null(self::$connection)){
				return self::$connection;
			}
			return false;
		}

		/*
		 * O método select é usado para fazer buscas no banco de dados, 
		 * o método só funcionará, caso a conexão com o banco de dados seja estabelecida.
		 *  (string) columns, coluna(s) da(s) tabela(s) ou * para retornar os 
		 *  dados de todas as colunas da tabela.
		 *  (string) table, nome(s) da(s) tabela(s) onde os dados serão buscados.
		 * Os dois valores abaixo, são opcionais quando para a coluna for passado o valor *.
		 *  (string) condition, condição para a busca dos dados (opcional).
		 *  (array) conditionValues, valores a serem passados para a condição.
		 *
		 *   Exemplo: 
		 *	   condition: "where user=? and password=?";
		 *	   conditionValues: ["example", "123"];
		 */
		public function select($columns, $table, $condition = null, $conditionValues = null){
			if($this->getConnection()){
				if(is_string($columns) && is_string($table)){
					if(empty($condition) && empty($conditionValues)){
						$query = $this->getConnection()->query("SELECT {$columns} FROM {$table}");
						
						return $query->fetchAll(PDO::FETCH_ASSOC);
					}
					else{
						if(is_string($condition) && is_array($conditionValues)){
							$query = $this->getConnection()->prepare(
								"SELECT {$columns} FROM {$table} {$condition}"
							);
							$query->execute($conditionValues);
						
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
		 * (string) table, nome da tabela onde os dados serão inseridos.
		 * (array) columns, colunas da tabela onde os dados serão inseridos.
		 * (array) values, valores a serem inseridos referentes às colunas da tabela.
		 */
		public function insert($table, $columns, $values){
			if($this->getConnection()){
				if(is_string($table) && is_array($columns) && is_array($values)){
					$columnFormat = "";
					$column = "";
					
					for($i = 0; $i < sizeof($columns); $i++){
						if($i < (sizeof($columns) - 1)){
							$columnFormat .= ":" . $columns[$i] . ", ";
							$column .= $columns[$i] . ", ";
						}
						else{
							$columnFormat .= ":" . $columns[$i];
							$column .= $columns[$i];
						}
					}
					$query = "INSERT INTO {$table}({$column}) VALUES({$columnFormat})";
					$query = $this->getConnection()->prepare($query);
					for($j = 0; $j < sizeof($columns); $j++){
						$query->bindParam(":" . $columns[$j], $values[$j], PDO::PARAM_STR);
					} 
					$query->execute();
					return true;
				}
			}
			return false;
		}
	}
?>