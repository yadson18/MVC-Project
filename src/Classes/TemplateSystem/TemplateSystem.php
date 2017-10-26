<?php 
    class TemplateSystem{
        private static $instance;
        private $controllerInstance;
        private $controllerName;
        private $controllerMethod;
        private $controllerArgs;
        private $templateToLoad;
        private $pageTitle;
        private $viewData;

        private function __construct(){
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
            if(is_file($this->getTemplate())){
                ob_start();

                foreach($this->getviewData() as $variableName => $value){
                    $$variableName = $value;
                }

                include $this->getTemplate();
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
            return $this->pageTitle;
        }

        protected function setControllerName(string $controllerName){
            if(!empty($controllerName)){
                $this->controllerName = $controllerName;
            }
        }

        public function getControllerName(){
            return $this->controllerName;
        }

        protected function setTemplateName(string $controllerMethod){
            if(!empty($controllerMethod)){
                $this->controllerMethod = $controllerMethod;
            }
        }

        public function getTemplateName(){
            return $this->controllerMethod;
        }

        protected function setControllerArgs($controllerArgs){
            $this->controllerArgs = $controllerArgs;
        }

        public function getControllerArgs(){
            return $this->controllerArgs;
        }

        protected function setTemplate(string $template){
            if(!empty($template) && file_exists(VIEW . "{$template}.php")){
                $this->templateToLoad = VIEW . "{$template}.php";
                return true;
            }
            return false;
        }

        public function getTemplate(){
            return $this->templateToLoad;
        }

        public function requestIs(string $requestMethod){
            if($_SERVER["REQUEST_METHOD"] === strtoupper($requestMethod)){
                return true;
            }
            return false;
        }

        protected function classExists(
            string $controllerName, string $controllerMethod, $requestData, $template = null
        ){
            if(!empty($controllerName) && class_exists($controllerName)){
                $this->controllerInstance = new $controllerName($requestData, $this);

                if(is_callable([$this->controllerInstance, $controllerMethod])){
                    if(is_callable([$this->controllerInstance, "isAuthorized"])){
                        if($this->controllerInstance->isAuthorized($controllerMethod)){
                            $redirect = $this->controllerInstance->$controllerMethod();
                            
                            if(!empty($redirect) && isset($redirect["redirectTo"])){
                                header("Location: {$redirect['redirectTo']}");
                            }

                            $this->setTemplate("{$this->controllerName}/{$controllerMethod}");
                            return true;
                        }
                    }
                }
            }
            
            return false;
        }

        protected function setUriConfig(string $uri){
            if(!empty($uri)){
                $args = explode("/", substr($uri, 1));
                $controller = array_shift($args);
                $method = array_shift($args);

                if(empty($method)){
                    if(empty($controller) && !empty(getDefaultRoute())){
                        $controller = getDefaultRoute()["controller"];
                        $method = getDefaultRoute()["view"];
                    }
                    else{
                        $method = "index";
                    }
                }

                $this->controllerName = ucfirst($controller);
                $this->controllerMethod = $method;
                $this->controllerArgs = $args;

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
                        $this->controllerInstance = NULL;

                        if($this->requestIs("POST")){
                            $requestData = (object) $_POST;
                        }
                        else if($this->requestIs("GET")){
                            $requestData = (object) $_GET;
                        }

                        $template = "{$this->controllerName}/{$this->controllerMethod}";

                        if($this->classExists(
                            $this->controllerName."Controller", $this->controllerMethod, $requestData
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
