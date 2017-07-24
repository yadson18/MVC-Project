<?php  
	trait Flash{
		public function flashError($message){
			$this->setMessage("error", $message);
		}

		public function flashSuccess($message){
			$this->setMessage("success", $message);
		}

		public function flashSuccessModal($message){
			$this->setMessage("successModal", $message);
		}

		public function flashWarning($message){
			$this->setMessage("warning", $message);
		}

		public function flashDaniedAccess($message){
			ob_start();
			include WWW_ROOT . "src/View/Flash/daniedAccess.php";
			echo ob_get_clean();
		}

		public function setMessage($flashType, $message){
			if(!empty($flashType) && !empty($message)){
				$this->setViewVars([
					"message" => [
						$flashType => $message
					]
				]);
			}
		}

		public function getFlashData($flashType){
			if(!empty($this->getViewVars("message"))){
				if(array_key_exists($flashType, $this->getViewVars("message"))){
					return [
						"template" => WWW_ROOT . "src/View/Flash/{$flashType}.php",
						"message" => $this->getViewVars("message")[$flashType]
					];
				}
			}
			return false;
		}

		public function clearMessage(){
			$this->setViewVars(["message" => ""]);
		}

		public function flashShowMessage(){
			ob_start();
			if($this->getFlashData("success")){
				$message = $this->getFlashData("success")["message"];
				include $this->getFlashData("success")["template"];
				$this->clearMessage();
				return ob_get_clean();
			}
			elseif($this->getFlashData("error")){
				$message = $this->getFlashData("error")["message"];
				include $this->getFlashData("error")["template"];
				$this->clearMessage();
				return ob_get_clean();
			}
			elseif($this->getFlashData("warning")){
				$message = $this->getFlashData("warning")["message"];
				include $this->getFlashData("warning")["template"];
				$this->clearMessage();
				return ob_get_clean();
			}
			elseif($this->getFlashData("successModal")){
				$message = $this->getFlashData("successModal")["message"];
				include $this->getFlashData("successModal")["template"];
				$this->clearMessage();
				return ob_get_clean();
			}
			else{
				return false;
			}
		}
	}
?>