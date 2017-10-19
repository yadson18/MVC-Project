<?php 
	class Session{
		public function __construct(){
			session_start(["cookie_lifetime" => 86400]);
		}

		public function startSession(){
			if(!isset($_SESSION["newSession"])){
				$_SESSION = [
					"newSession" => [],
					"logged" => true,
					"created" => date("H:i")
				];
			}
		}

		public function createNewId($minutes){
			if(isset($_SESSION["newSession"])){
				$time = 60 * $minutes;
				
				if((strtotime(date("H:i")) - strtotime($_SESSION["created"])) >= $time){
					session_regenerate_id(); 
					$_SESSION["created"] = date("H:i");
				}
			}
		}

		public function getData(){
			if(isset($_SESSION["newSession"])){
				return array_map("unserialize", $_SESSION["newSession"]);
			}
		}

		public function setData($index, $data){
			$this->startSession();
			$this->createNewId(5);

			if(!empty($index) && is_string($index)){
				if(!empty($data)){
					$_SESSION["newSession"][$index] = serialize($data);
				}
			}
		}

		public function close(){
			if(isset($_SESSION["newSession"])){
				session_destroy();
			}
		}
	}