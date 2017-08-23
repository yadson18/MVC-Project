<?php  
	class ConnectionExample extends Connection{
		static $dsn = 'firebird:dbname=localhost:/BD/DBNAME.FDB; charset=utf8';
		static $user = 'SYSDBA';
		static $password = 'masterkey';
		
		public function __construct(){
			parent::__construct(self::$dsn , self::$user , self::$password);

			if(!$this->getConnection()){
				return false;
			}
		}
	}
?>