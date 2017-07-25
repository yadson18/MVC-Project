<?php  
	/*
	 * O trait Flash é usado para criar mensagens de erro, sucesso, atenção, acesso negado, 
	 * baseado em templates.
	 */
	trait Flash{
		/* 
		 * Este método cria uma mesnsagem de erro.
		 *
		 * (string) message, mensagem a ser exibida ao usuário.
		 */
		public function flashError($message){
			$this->setMessage("error", $message);
		}

		/* 
		 * Este método cria uma mesnsagem de sucesso.
		 *
		 * (string) message, mensagem a ser exibida ao usuário.
		 */
		public function flashSuccess($message){
			$this->setMessage("success", $message);
		}

		/* 
		 * Este método cria um modal com uma mensagem de sucesso.
		 *
		 * (string) message, mensagem a ser exibida ao usuário.
		 */
		public function flashSuccessModal($message){
			$this->setMessage("successModal", $message);
		}

		/* 
		 * Este método cria uma mesnsagem de atenção.
		 *
		 * (string) message, mensagem a ser exibida ao usuário.
		 */
		public function flashWarning($message){
			$this->setMessage("warning", $message);
		}

		/* 
		 * Este método cria uma página de erro, onde o usuário será redirecionado caso 
		 * não tenha acesso autorizado ou caso a URL esteja incorreta.
		 *
		 * WWW_ROOT é uma constante onde está salvo o caminho até o diretório raiz do 
		 * projeto, visível globalmente no código.
		 *
		 * 	(string) message, mensagem a ser exibida ao usuário.
		 */
		public function flashDaniedAccess($message){
			ob_start();
			include WWW_ROOT . "src/View/Flash/daniedAccess.php";
			echo ob_get_clean();
		}

		/*
		 * Método para salvar a mensagem que deverá ser exibida ao usuário.
		 *
		 *	(string) flashType, o tipo do flash que deseja guardar a mensagem Ex: success.
		 *	(string) message, mensagem que será exibida ao usuário.
		 */
		public function setMessage($flashType, $message){
			if(!empty($flashType) && !empty($message)){
				$this->setViewVars([
					"message" => [
						$flashType => $message
					]
				]);
			}
		}

		/*
		 * Este método checa se existe uma mensagem relacionada ao tipo de flash que for especificado, 
		 * caso exista, serão retornados, o caminho até o template da mensagem e a mensagem que será 
		 * exibida, se não existir, o retono será false.
		 *
		 * WWW_ROOT é uma constante onde está salvo o caminho até o diretório raiz do 
		 * projeto, visível globalmente no código.
		 *
		 *	(string) flashType, o tipo do flash que deseja guardar a mensagem Ex: error.
		 */
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


		// Este método limpa as mensagens mostradas ao usuário, após elas serem exibidas.
		public function clearMessage(){
			$this->setViewVars(["message" => ""]);
		}

		/*
		 * Este método checa se existe mensagem relacionada a algum tipo de flash,
		 * se existir, o buffer de saída do PHP é usado para capturar o conteúdo do template e 
		 * exibir a mensagem ao usuário, caso não exista, o retorno será false.
		 */
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