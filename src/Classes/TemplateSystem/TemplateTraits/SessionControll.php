<?php 
	session_id(getSalt());
	session_start();

	trait SessionControll{
		public function getSession(){
			if(!isset($_SESSION["newSession"])){
				$_SESSION["newSession"] = ["logged" => true];
			}
			else{
				return true;
			}
		}

		public function setDataSession($data){
			if(!empty($data) && is_array($data)){
				if(isset($_SESSION["newSession"])){
					# code...
				}
			}
		}
	}
?>