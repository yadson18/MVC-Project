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

		public function setDataSession($index, $data){
			if($this->getSession()){
				if(!empty($index) && is_string($index)){
					if(!empty($data)){
						$_SESSION["newSession"][$index] = serialize($data);
					}
				}
			}
		}
	}
?>