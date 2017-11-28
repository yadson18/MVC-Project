<?php 
    namespace Simple\TemplateSystem;

    use Simple\Configurator\Configurator;
    use Simple\Components\Component;
    use Simple\TemplateSystem\Component\TemplateController;

    class TemplateSystem
    {
        private static $Instance;

        private function __construct(){}

        public static function getInstance()
        {
            if (!isset(self::$Instance)) {
                self::$Instance = new TemplateSystem();
            }
            return self::$Instance;
        }

        public function initialize()
        {
            if ($this->setUrlRewriteParameters($_SERVER["REQUEST_URI"])) {
                $this->loadComponent("Html");
                $this->loadComponent("Form"); 
                $this->loadComponent("Flash");

                $this->loadTemplate();
            }
        }

        protected function loadComponent(string $componentName)
        {
            $Component = new Component($componentName);

            $this->$componentName = $Component->load();
        }

        protected function setUrlRewriteParameters(string $uri)
        {
            if (!empty($uri)) {
                $Configurator = Configurator::getInstance();
                $TemplateControl = TemplateController::getInstance();

                $controllerMethodArgs = explode("/", substr($uri, 1));
                $controllerName = array_shift($controllerMethodArgs);
                $controllerAction = array_shift($controllerMethodArgs);

                if (empty($controllerAction)) {
                    if (empty($controllerName)) {
                        if (!empty($Configurator->get("DefaultRoute"))) {
                            $controllerName = ucfirst($Configurator->get("DefaultRoute", "controller"));
                            $controllerAction = $Configurator->get("DefaultRoute", "view");
                        }
                    }
                    else {
                        $controllerAction = "index";
                    }
                }
                if (!empty($controllerMethodArgs) && sizeof($controllerMethodArgs) === 1) {
                    $controllerMethodArgs = array_shift($controllerMethodArgs);
                }

                $TemplateControl->setMethodArgs($controllerMethodArgs);
                $TemplateControl->setName($controllerName);
                $TemplateControl->setMethod($controllerAction);

                return true;
            }
            return false;
        }

        protected function loadTemplate()
        {
            $TemplateControl = TemplateController::getInstance();

            if ($this->requestIs("POST") || $this->requestIs("GET")) {
                $TemplateControl->deleteControllerInstance();

                if ($this->callControllerMethod($TemplateControl->getName(), $TemplateControl->getMethod())) {
                    if ($TemplateControl->getControllerInstance()->Ajax->notEmptyResponse()) {
                        echo $TemplateControl->getControllerInstance()->Ajax->getResponse();
                    }
                    else if ($TemplateControl->getTemplate()) {
                        include VIEW . "Default/default.php";
                        exit();
                    }
                    else {
                        include Configurator::getInstance()->get("DefaultErrorPage");
                        exit();
                    }
                }
                else {
                    include Configurator::getInstance()->get("DefaultErrorPage");
                    exit();
                }
            }
        }

        protected function callControllerMethod(string $controllerName, string $controllerMethod)
        {
            $TemplateControl = TemplateController::getInstance();

            if ($TemplateControl->setControllerInstance($controllerName)) {
                $Controller = $TemplateControl->getControllerInstance();

                if ($TemplateControl->callableMethodController("isAuthorized")) {
                    if ($Controller->isAuthorized($controllerMethod)) {
                        if ($TemplateControl->callableMethodController($controllerMethod)) {
                            $this->Flash = $Controller->Flash;
                            $controllerReturn = $Controller->$controllerMethod(
                                $TemplateControl->getMethodArgs()
                            );

                            if (!empty($controllerReturn)) {
                                if (isset($controllerReturn["redirectTo"])) {
                                    header("Location: {$controllerReturn['redirectTo']}");
                                }
                            }
                            $TemplateControl->setTemplate("{$controllerName}/{$controllerMethod}");
                            return true;
                        }
                    }
                }
            }
            return false;
        }

        protected function fetchAll()
        { 
            ob_start();

            $viewData = TemplateController::getInstance()->getControllerInstance()->getviewData();
            if (!empty($viewData)) {
                foreach ($viewData as $variableName => $value) {
                    $$variableName = $value;
                }
            }
            include TemplateController::getInstance()->getTemplate();

            return ob_get_clean();
        }

        protected function requestIs(string $requestMethod)
        {
            return requestIs($requestMethod);
        } 

        public function getAppName()
        {
            return Configurator::getInstance()->get("AppName");
        }

        public function getViewTitle()
        {
            return TemplateController::getInstance()->getControllerInstance()->getViewTitle();
        }
    }