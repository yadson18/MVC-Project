<?php  
	namespace Simple\ORM\Component;
	/* 
	 * A classe Connection, serve para conectar-se a vários tipos de bancos de dados 
	 * através do PDO, tais como MySql, Firebird, PostgreSQL...
	 *
	 * Para a lista completa de bancos de dados suportados, consulte o manual do PHP.
	 */
	use \PDO;

	abstract class Connection
	{
		private static $Instance;

		/*
		 * Para o construtor da classe devem ser passados,
		 *  (string) dsn, parâmetros de conexão,
		 *  (string) user, usuário,
		 *  (string) password, senha do usuário.
		 *  Se a conexão com a base de dados for estabelecida, será retornada 
		 *  a instância do PDO, caso contrário retornará falso. 
		 */
		
		private function __construct(){}

		public static function getInstance(string $dbType, array $dbConfig)
		{
			try{
				self::$Instance = new PDO(
					"{$dbType}:dbname={$dbConfig['host']}:{$dbConfig['path']}; charset={$dbConfig['charset']}",
					$dbConfig["user"], $dbConfig["password"]
				);
				self::$Instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$Instance->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);

				return self::$Instance;
			}
			catch(PDOException $e){
				return false;
			}
		}
	}