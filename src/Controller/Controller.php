<?php 
	session_start();
	
	class Controller{
		private $templateSystem;

		public function __construct($requestData, $templateSystem){
			$this->templateSystem = $templateSystem;
		}

		public function setData($data){
			$this->templateSystem->setViewVars($data);
		}

		/*public function flash($method, $message){
			$methods = ["Error", "Success", "SuccessModal", "Warning"];

			if(in_array($method, $methods) && !empty($message)){
				$method = "flash{$method}";
				$this->templateSystem->$method($message);
				return true;
			}
			return false;
		}*/

		public function setTitle($title){
			if(is_string($title) && !empty($title)){
				$this->setData(["title" => $title]);
			}
		}

		public function authorizedToAccess($method, $methods, $user){
			if(!empty($user)){
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

		public function requestMethodIs($requestMethod){
	      if($_SERVER["REQUEST_METHOD"] === strtoupper($requestMethod)){
	        return true;
	      }
	      return false;
	    }
	}
?>