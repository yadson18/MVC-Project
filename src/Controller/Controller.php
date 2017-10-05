<?php 
	abstract class Controller implements ControllerInterface{
		private $templateSystem;

		public function __construct($requestData, $templateSystem){
			$this->templateSystem = $templateSystem;
		}

		public function setViewData($variables){
			$this->templateSystem->setViewData($variables);
		}

		public function setPageTitle($title){
			$this->templateSystem->setPageTitle($title);
		}

		public function requestMethodIs($requestMethod){
			return $this->templateSystem->requestMethodIs($requestMethod);
	    }

	    public function flash($messageType, $messageText){
			$messageTypes = ["error", "success", "warning"];

			if(!empty($messageType) && in_array($messageType, $messageTypes)){
				$method = "flash" . ucfirst($messageType);
				$this->templateSystem->$method($messageText);
			}
		}

		public function notAlowed($method, $methods){
			if(is_array($methods) && !empty($methods)){
				if(is_string($method) && !empty($method)){
					if(in_array($method, $methods)){
						return true;
					}	
				}
			}
			return false;
		}

		public function redirectTo($url){
			if(!empty($url) && is_array($url)){
				if(isset($url["controller"]) && !empty($url["controller"])){
					if(!isset($url["view"])){
						return ["redirectTo" => "/{$url['controller']}/index"];
					}
					else if(isset($url["view"]) && !empty($url["view"])){
						return ["redirectTo" => "/{$url['controller']}/{$url['view']}"];
					}
				}
			}
			return false;
		}
	}
?>