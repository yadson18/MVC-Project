<?php  
    namespace Simple\TemplateSystem\Component;

    use Controller;

    class TemplateController{
        private static $Instance;
        private $ControllerInstance;
        private $controllerName;
        private $methodName;
        private $methodArgs;
        private $templateName;

        private function __construct(){}

        public static function getInstance(){
            if(!isset(self::$Instance)){
                self::$Instance = new TemplateController();
            }
            return self::$Instance;
        }

        public function setControllerInstance(string $controllerName){
            $Controller = "Controller\\{$controllerName}Controller";

            if(class_exists($Controller)){
                $this->ControllerInstance = new $Controller();

                if(!empty($this->ControllerInstance)){
                    return $this->ControllerInstance;
                }  
            }
            return false;
        }
        public function getControllerInstance(){
        	return $this->ControllerInstance;
        }

        public function deleteControllerInstance(){
            $this->ControllerInstance = NULL;
        }

        public function setName(string $controllerName){
        	if(!empty($controllerName)){
        		$this->controllerName = $controllerName;
        	}
        }
        public function getName(){
        	return $this->controllerName;
        }

        public function setMethod(string $methodName){
        	if(!empty($methodName)){
        		$this->methodName = $methodName;
        	}
        }
        public function getMethod(){
        	return $this->methodName;
        }

        public function setMethodArgs($args){
            if(!empty($args)){
                $this->methodArgs = $args;
            }
        }
        public function getMethodArgs(){
            return $this->methodArgs;
        }

        public function setTemplate(string $template){
            if(!empty($template) && file_exists(VIEW . "{$template}.php")){
                $this->templateName = VIEW . "{$template}.php";
                return true;
            }
            return false;
        }
        public function getTemplate(){
            if(!empty($this->templateName)){
                return $this->templateName;
            }
            return false;
        }

        public function callableMethodController(string $methodName){
            if(!empty($this->ControllerInstance)){
                if(!empty($methodName) && is_callable([$this->ControllerInstance, $methodName])){
                    return true;
                }
            }
            return false;
        }
	}
?>