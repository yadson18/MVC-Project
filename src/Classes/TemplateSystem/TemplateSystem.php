<?php 
    class TemplateSystem{
        private static $instance;
        private $pageTitle;
        private $viewData;

        private function __construct(){
            $this->loadModule("Controller");
            $this->loadModule("Session");
            $this->loadModule("Html");
            $this->loadModule("Ajax");
            $this->loadModule("Flash");
        }

        public static function getInstance(){
            if(!isset(self::$instance)){
                self::$instance = new TemplateSystem();
            }
            return self::$instance;
        }

        protected function fetchAll(){ 
            if(is_file($this->Controller->getTemplate())){
                ob_start();

                foreach($this->getviewData() as $variableName => $value){
                    $$variableName = $value;
                }

                include $this->Controller->getTemplate();
                return ob_get_clean();
            }
        } 

        public function getAppName(){
            return getAppName();
        }

        protected function loadModule(string $module){
            if(file_exists(CLASSES . "TemplateSystem/Modules/{$module}.php") && class_exists($module)){
                $this->$module = new $module();
            }
        }

        public function setViewData(array $variables, array $variablesToSerialize = null){
            if(!empty($variables)){
                foreach($variables as $variableName => $value){
                    if(!empty($variableName) && is_string($variableName)){
                        if(!empty($variablesToSerialize)){
                            if(isset($variablesToSerialize["_serialize"])){
                                if(in_array($variableName, $variablesToSerialize["_serialize"])){
                                    if(!empty($value)){
                                        $this->Session->setData($variableName, $value);
                                    }
                                }
                                else{
                                    $this->viewData[$variableName] = $value;
                                }
                            }
                        }
                        else{
                            $this->viewData[$variableName] = $value;
                        }
                    }
                }
            }
        }

        public function getviewData(){
            if(!empty($this->viewData) && !empty($this->Session->getData())){
                return array_merge($this->viewData, $this->Session->getData());
            }
            else if(!empty($this->viewData) && empty($this->Session->getData())){
                return $this->viewData;
            }
            else if(empty($this->viewData) && !empty($this->Session->getData())){
                return $this->Session->getData();
            }
            return false;
        }

        public function setPageTitle(string $title){
            if(!empty($title)){
                $this->pageTitle = $title;
            }
        }

        public function getPageTitle(){
            if(!empty($this->pageTitle)){
                return $this->pageTitle;
            }
            return $this->Controller->getMethod();
        }

        public function requestIs(string $requestMethod){
            if($_SERVER["REQUEST_METHOD"] === strtoupper($requestMethod)){
                return true;
            }
            return false;
        }

        protected function callControllerMethod(string $controllerName, string $controllerMethod, $requestData){
            if($this->Controller->createInstance($controllerName, $requestData, $this)){
                $controller = $this->Controller->getInstance();

                if($this->Controller->callableMethod("isAuthorized") && $controller->isAuthorized($controllerMethod)){
                    if($this->Controller->callableMethod($controllerMethod)){
                        $controllerReturn = $controller->$controllerMethod();

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
                $requestData = explode("/", substr($uri, 1));
                $controllerName = array_shift($requestData);
                $method = array_shift($requestData);

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
                $this->Controller->setRequestData($requestData);

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

        public function loadTemplate(){
            if(is_file($_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'])){
                include $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'];
            } 
            else{
                if($this->setUriConfig($_SERVER["REQUEST_URI"])){
                    if($this->requestIs("POST") || $this->requestIs("GET")){
                        $this->Controller->deleteInstance();

                        if($this->requestIs("POST")){
                            $this->Controller->setRequestData($_POST);
                        }
                        else if($this->requestIs("GET") && !empty($_GET)){
                            $this->Controller->setRequestData($_GET);
                        }

                        if($this->callControllerMethod(
                            $this->Controller->getName(), $this->Controller->getMethod(), $this->Controller->getRequestData()
                        )){
                            if($this->Ajax->notEmptyResponse()){
                                echo $this->Ajax->getResponse();
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
    }
