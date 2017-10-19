<?php  
	/* 
	 * A classe Connection, serve para conectar-se a vários tipos de bancos de dados 
	 * através do PDO, tais como MySql, Firebird, PostgreSQL...
	 *
	 * Para a lista completa de bancos de dados suportados, consulte o manual do PHP.
	 */
	abstract class Connection{
		private static $instance;

		/*
		 * Para o construtor da classe devem ser passados,
		 *  (string) dsn, parâmetros de conexão,
		 *  (string) user, usuário,
		 *  (string) password, senha do usuário.
		 *  Se a conexão com a base de dados for estabelecida, será retornada 
		 *  a instância do PDO, caso contrário retornará falso. 
		 */
		private function __construct(){}

		public static function getInstance($dsn, $user, $password){
			try{
				self::$instance = new PDO($dsn, $user, $password);
				self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$instance->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);

				return self::$instance;
			}
			catch(PDOException $e){
				return false;
			}
		}
	}