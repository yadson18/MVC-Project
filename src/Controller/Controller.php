<?php  
	session_start();
	
	class Controller{
		use Session;
		use Flash;

		public $templateSystem;

		public function __construct($requestData, $templateSystem){
			$this->templateSystem = $templateSystem;
		}

		public function set($method){
			$this->templateSystem->$method(["pass" => "123"]);
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

	   	public function serializeData($data){
	   		if(is_array($data) && !empty($data)){
	   			return $data;
	   		}
	   		return false;
	    }

	    public function save($connection, $table, $values){
	    	$columns = array();
	    	$postValues = array();

	    	foreach($values as $index => $value){
	    		array_push($columns, strtoupper($index));
	    		array_push($postValues, replace($_POST[$index]));
	    	}

	    	$saved = $connection->insert($table, $columns, $postValues);

	    	if(!empty($saved)){
	    		return true;
	    	}
	    	return false;
	    }
	}
?>