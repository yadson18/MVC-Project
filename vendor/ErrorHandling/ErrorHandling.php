<?php  
	class ErrorHandling{
		private $currentClassName;

		public function __construct(string $currentClassName){
			$this->currentClassName = $currentClassName;
		}

		protected function displayError(){
			return getDisplayErrors();
		}

		public function stopExecution(string $code, string $message, int $line){
			if($this->displayError()){
				if(!empty($message) && !empty($line)){
					echo "<p>
							<i>Error in</i> <strong>{$this->currentClassName}</strong>, 
							<i>line</i> <strong>{$line}</strong>
						  </p>
						  <p>Code <strong>{$code}</strong>: {$message}</p>";
					exit();
				}
			}
			return false;
		}
	}