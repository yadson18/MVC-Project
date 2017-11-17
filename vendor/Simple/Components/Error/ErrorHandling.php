<?php  
	namespace Simple\Components\Error;

	class ErrorHandling
	{
		private $currentClassName;

		public function __construct(string $currentClassName){
			$this->Config = Configurator::getInstance();
			$this->currentClassName = $currentClassName;
		}

		public function stopExecution(string $code, string $message, int $line){
			if($this->Config->get("DisplayErrors")){
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