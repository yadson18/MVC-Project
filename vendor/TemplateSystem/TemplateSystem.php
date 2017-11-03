<?php 
    class TemplateSystem{
        private static $Instance;

        private function __construct(){
            $this->loadModule("Controller");
            $this->loadModule("Html");
            $this->loadModule("Form");
            $this->loadModule("Flash");
        }

        public static function getInstance(){
            if(!isset(self::$Instance)){
                self::$Instance = new TemplateSystem();
            }
            return self::$Instance;
        }

        protected function fetchAll(){ 
            if(is_file($this->Controller->getTemplate())){
                ob_start();

                $viewData = $this->Controller->getInstance()->getviewData();
                if(!empty($viewData)){
                    foreach($viewData as $variableName => $value){
                        $$variableName = $value;
                    }
                }

                include $this->Controller->getTemplate();
                return ob_get_clean();
            }
        } 

        public function getAppName(){
            return getAppName();
        }

        public function getViewTitle(){
            return $this->Controller->getInstance()->getViewTitle();
        }

        protected function loadModule(string $module){
            if(file_exists(VENDOR . "Modules/{$module}.php") && class_exists($module)){
                $this->$module = new $module();
            }
        }

        protected function callControllerMethod(string $controllerName, string $controllerMethod){
            if($this->Controller->createInstance($controllerName, $this->Controller->getRequestData())){
                $Controller = $this->Controller->getInstance();

                if($this->Controller->callableMethod("isAuthorized") && $Controller->isAuthorized($controllerMethod)){
                    if($this->Controller->callableMethod($controllerMethod)){
                        $this->Flash = $Controller->Flash;
                        $controllerReturn = $Controller->$controllerMethod($this->Controller->getMethodArgs());

                        if(!empty($controllerReturn)){
                            if(isset($controllerReturn["redirectTo"])){
                                header("Location: {$controllerReturn['redirectTo']}");
                            }
                        }
                        $this->Controller->setTemplate("{$controllerName}/{$controllerMethod}");
                        return true;
                    }
                }
            }
            return false;
        }

        protected function setUriConfig(string $uri){
            if(!empty($uri)){
                $methodArgs = explode("/", substr($uri, 1));
                $controllerName = array_shift($methodArgs);
                $method = array_shift($methodArgs);

                if(empty($method)){
                    if(empty($controllerName) && !empty(getDefaultRoute())){
                        $controllerName = getDefaultRoute()["controller"];
                        $method = getDefaultRoute()["view"];
                    }
                    else{
                        $method = "index";
                    }
                }
                $this->Controller->setName(ucfirst($controllerName));
                $this->Controller->setMethod($method);
                if(!empty($methodArgs)){
                    if(sizeof($methodArgs) === 1){
                        $methodArgs = array_shift($methodArgs);
                    }
                    $this->Controller->setMethodArgs($methodArgs);
                }
                return true;
            }
            return false;
        }

        protected function showDefaultPageError(string $messageToDisplay){
            if(is_file(VIEW . "ErrorPages/" . getDefaultErrorPage())){
                ob_start();
                $message = $messageToDisplay;
                include VIEW . "ErrorPages/" . getDefaultErrorPage();
                return ob_get_clean();
            }
        }

        protected function requestIs(string $requestMethod){
            return requestIs($requestMethod);
        }

        public function loadTemplate(){
            if($this->setUriConfig($_SERVER["REQUEST_URI"])){
                if($this->requestIs("POST") || $this->requestIs("GET")){
                    $this->Controller->deleteInstance();

                    if($this->requestIs("POST")){
                        $this->Controller->setRequestData($_POST);
                    }
                    else if($this->requestIs("GET")){
                        $this->Controller->setRequestData($_GET);
                    }

                    if($this->callControllerMethod($this->Controller->getName(), $this->Controller->getMethod())){
                        if($this->Controller->getInstance()->Ajax->notEmptyResponse()){
                            echo $this->Controller->getInstance()->Ajax->getResponse();
                        }
                        else{
                            include VIEW . "Default/default.php";  
                            exit();
                        }
                    }
                    else{
                        echo $this->showDefaultPageError("Acesso Negado");
                    }
                }
            }
        }
    }
