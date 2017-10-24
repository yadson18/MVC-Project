<?php 
	abstract class Controller implements ControllerInterface{
		private $templateSystem;

		public function __construct($requestData, $templateSystem){
			$this->templateSystem = $templateSystem;
		}

		public function setViewData($variables, $variablesToSerialize = null){
			$this->templateSystem->setViewData($variables, $variablesToSerialize);
		}

		public function setPageTitle($title){
			$this->templateSystem->setPageTitle($title);
		}

		public function newEntity($className){
	      if(!empty($className) && is_string($className)){
	        $className = ucfirst($className);
	        if(class_exists($className)){
	          return new $className();
	        }
	      }
	      return false;
	    }

		public function requestIs($requestMethod){
			return $this->templateSystem->requestIs($requestMethod);
	    }

	    public function flash($messageType, $messageText){
			$messageTypes = ["error", "success", "warning"];

			if(!empty($messageType) && in_array($messageType, $messageTypes)){
				$method = "flash" . ucfirst($messageType);
				$this->templateSystem->Flash->$method($messageText);
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

		public function redirect($url){
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