<?php  
	trait Flash{
		public function flashError($message){
			$this->serializeData(["message" => ["error" => $message]]);
		}

		public function flashSuccess($message){
			$this->serializeData(["message" => ["success" => $message]]);
		}

		public function flashSuccessModal($message){
			$this->serializeData(["message" => ["successModal" => $message]]);
		}

		public function flashWarning($message){
			$this->serializeData(["message" => ["warning" => $message]]);
		}

		public static function showMessage(){
			if(Session::getCurrent()){
				ob_start();
				if(array_key_exists("message", Session::getCurrent())){
					if(array_key_exists("error", Session::getCurrent()["message"])){
						$message = Session::getCurrent()["message"]["error"];
						include "src/View/FlashMessageTemplates/error.php";
						unset($_SESSION[Session::getId()]["message"]);
						return ob_get_clean();
					}
					else if(array_key_exists("success", Session::getCurrent()["message"])){
						$message = Session::getCurrent()["message"]["success"];
						include "src/View/FlashMessageTemplates/success.php";
						unset($_SESSION[Session::getId()]["message"]);
						return ob_get_clean();
					}
					else if(array_key_exists("warning", Session::getCurrent()["message"])){
						$message = Session::getCurrent()["message"]["warning"];
						include "src/View/FlashMessageTemplates/warning.php";
						unset($_SESSION[Session::getId()]["message"]);
						return ob_get_clean();
					}
					else if(array_key_exists("successModal", Session::getCurrent()["message"])){
						$message = Session::getCurrent()["message"]["successModal"];
						include "src/View/FlashMessageTemplates/successModal.php";
						unset($_SESSION[Session::getId()]["message"]);
						return ob_get_clean();
					}
				}
			}
			return false;
		}
	}
?>