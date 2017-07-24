<?php  
	session_start();
	
	class Controller{
		use Session;
		use Flash;

		public $templateSystem;

		public function __construct($requestData, $templateSystem){
			$this->templateSystem = $templateSystem;
		}

		public function setViewVars($data){
			if(!empty($data) && is_array($data)){
				$this->templateSystem->setViewVars($data);
			}
		}

		public function setTitle($title){
			$this->templateSystem->setTitle($title);
		}

		public function setLoggedUser($user){
			$this->templateSystem->setLoggedUser($user);
		} 

		public function authorizedToAccess($method, $methods, $loggedUser){
			if($loggedUser === true){
				return true;
			}
			else{
				if(is_array($methods) && !empty($methods)){
					if(in_array($method, $methods)){
						return true;
					}	
				}
			}
			return false;
		}

		public function redirectTo($url){
			if(is_array($url)){
				if(sizeof($url) == 1){
					return ["redirectTo" => "/{$url['controller']}/index"];
				}
				return ["redirectTo" => "/{$url['controller']}/{$url['view']}"];
			}
			return false;
		}

		public function requestMethodIs($requestMethod){
	      if(strcmp($_SERVER['REQUEST_METHOD'], $requestMethod) == 0){
	        return true;
	      }
	      return false;
	    }
	}
?>