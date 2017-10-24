<?php 
	abstract class Controller implements ControllerInterface{
		private $templateSystem;

		public function __construct($requestData, $templateSystem){
			$this->templateSystem = $templateSystem;
		}

		public function setViewData(array $variables, array $variablesToSerialize = null){
			$this->templateSystem->setViewData($variables, $variablesToSerialize);
		}

		public function setPageTitle(string $title){
			$this->templateSystem->setPageTitle($title);
		}

		public function newEntity(string $className){
	      if(!empty($className)){
	        $className = ucfirst($className);
	        if(class_exists($className)){
	          return new $className();
	        }
	      }
	      return false;
	    }

		public function requestIs(string $requestMethod){
			return $this->templateSystem->requestIs($requestMethod);
	    }

	    public function flash(string $messageType, string $messageText){
			$messageTypes = ["error", "success", "warning"];

			if(!empty($messageType) && in_array($messageType, $messageTypes)){
				$method = "flash" . ucfirst($messageType);
				$this->templateSystem->Flash->$method($messageText);
			}
		}

		public function notAlowed(string $method, array $methods){
			if(!empty($methods) && !empty($method)){
				if(in_array($method, $methods)){
					return true;
				}
			}
			return false;
		}

		public function redirect(array $url){
			if(!empty($url)){
				if(!isset($url["controller"]) && isset($url["view"]) && !empty($url["view"])){
					return ["redirectTo" => "/{$this->templateSystem->getControllerName()}/{$url['view']}"];
				}
				else if(isset($url["controller"]) && isset($url["view"])){
					if(!empty($url["controller"]) && !empty($url["view"])){
						return ["redirectTo" => "/{$url['controller']}/{$url['view']}"];
					}
				}
			}
			return false;
		}
	}