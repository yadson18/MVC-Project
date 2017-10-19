<?php  
	/*
	 * A classe Flash é usado para criar mensagens de erro, sucesso, atenção, acesso negado, 
	 * baseado em templates.
	 */
	class Flash{
		private $messageType;
		private $messageText;

		/*
		 * Método para salvar a mensagem que deverá ser exibida ao usuário.
		 *
		 *	(string) messageType, o tipo do flash que deseja guardar a mensagem Ex: success.
		 *	(string) messageText, mensagem que será exibida ao usuário.
		 */
		public function setMessage($messageType, $messageText){
			if(!empty($messageType) && is_string($messageType)){
				if(!empty($messageText) && is_string($messageText)){
					$this->messageType = $messageType;
					$this->messageText = $messageText;
				}
			}
		}

		/*
		 * Este método checa se existe mensagem relacionada a algum tipo de flash,
		 * se existir, o buffer de saída do PHP é usado para capturar o conteúdo do template e 
		 * exibir a mensagem ao usuário, caso não exista, o retorno será false.
		 */
		public function showMessage(){
			ob_start();

			if(isset($this->messageType) && isset($this->messageText)){
				if(file_exists(APP . "View/Flash/{$this->messageType}.php")){
					$message = $this->messageText;
					include APP . "View/Flash/{$this->messageType}.php";
					$this->clearMessage();
					return ob_get_clean();
				}
			}
		}

		// Este método limpa as mensagens mostradas ao usuário, após elas serem exibidas.
		public function clearMessage(){
			unset($this->messageType);
			unset($this->messageText);
		}

		/* 
		 * Este método cria uma mesnsagem de erro.
		 *
		 * (string) message, mensagem a ser exibida ao usuário.
		 */
		public function flashError($messageText){
			$this->setMessage("error", $messageText);
		}

		/* 
		 * Este método cria uma mesnsagem de sucesso.
		 *
		 * (string) message, mensagem a ser exibida ao usuário.
		 */
		public function flashSuccess($messageText){
			$this->setMessage("success", $messageText);
		}

		/* 
		 * Este método cria uma mesnsagem de atenção.
		 *
		 * (string) message, mensagem a ser exibida ao usuário.
		 */
		public function flashWarning($messageText){
			$this->setMessage("warning", $messageText);
		}
	}