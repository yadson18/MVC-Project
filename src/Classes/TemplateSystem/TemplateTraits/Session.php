<?php
	trait Session{
		public function setId($id){
			$_SESSION["id"] = $id;
		}

		public static function getId(){
			if(!isset($_SESSION["id"])){
				self::setId(sha1(time() . session_id()));
			}
			return $_SESSION["id"];
		}

		public function saveData($data){
			if(is_array($data)){
				foreach($data as $index => $values){
					$_SESSION[self::getId()][$index] = $values;
				}
				return true;
			}
			return false;
		}

		public function getData($index){
			if(isset($_SESSION[self::getId()][$index])){
				return $_SESSION[self::getId()][$index];
			}
			return false;
		}

		public function destroyData(){
			if(isset($_SESSION[self::getId()])){
				unset($_SESSION);
				session_destroy();
			}
		}
	}