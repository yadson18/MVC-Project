<?php  
	class Controller{
        private $instance;
        private $controller;
        private $method;
        private $requestData;
        private $template;

        public function createInstance(string $controllerName, $requestData, $templateSystem){
        	$controllerName = "{$controllerName}Controller";

        	if(!empty($controllerName) && !empty($templateSystem)){
        		if(class_exists($controllerName) && is_object($templateSystem)){
	        		$this->instance = new $controllerName($requestData, $templateSystem);

	        		if(!empty($this->instance)){
	        			return true;
	        		}
        		}
        	}
        	return false;
        }
        public function getInstance(){
        	return $this->instance;
        }

        public function deleteInstance(){
            $this->instance = NULL;
        }

        public function setName(string $controllerName){
        	if(!empty($controllerName)){
        		$this->controller = $controllerName;
        	}
        }
        public function getName(){
        	return $this->controller;
        }

        public function setMethod(string $methodName){
        	if(!empty($methodName)){
        		$this->method = $methodName;
        	}
        }
        public function getMethod(){
        	return $this->method;
        }

        public function setRequestData(array $requestData){
            if(!empty($requestData)){
                $formatedRequestData = [];

                while($requestData){
                    $key = array_shift($requestData);
                    
                    if(!empty($key) && is_string($key)){
                        $value = array_shift($requestData);

                        if(!empty($value)){
                            $formatedRequestData[$key] = $value;
                        }
                    }
                }

                $this->requestData = $formatedRequestData;
            }
            else{
        	   $this->requestData = $requestData;
            }
        }
        public function getRequestData(){
        	return (object) $this->requestData;
        }

        public function setTemplate(string $template){
            if(!empty($template) && file_exists(VIEW . "{$template}.php")){
                $this->template = VIEW . "{$template}.php";
                return true;
            }
            return false;
        }
        public function getTemplate(){
            return $this->template;
        }

        public function callableMethod(string $methodName){
            if(!empty($this->instance)){
                if(!empty($methodName) && is_callable([$this->instance, $methodName])){
                    return true;
                }
            }
            return false;
        }
	}
?>