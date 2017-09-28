<?php 
  class TemplateSystem{
    use Html;

    private static $instance;
    private $controllerInstance;
    private $controllerName;
    private $controllerMethod;
    private $controllerArgs;
    private $templateToLoad;
    private $viewVars;

    private function __construct(){
      $this->viewVars = [];
    }

    public static function getInstance(){
      if(!isset(self::$instance)){
        self::$instance = new TemplateSystem();
      }
      return self::$instance;
    }

    public function fetchAll(){ 
      if(is_file($this->getTemplate())){
        ob_start();
        include $this->getTemplate();
        return ob_get_clean();
      }
    } 

    public function setViewVars($data){
      if(!empty($data) && is_array($data)){
        array_push($this->viewVars, $data);
      }
      return false;
    }

    public function getViewVars(){
      return $this->viewVars;
    }

    public function getControllerName(){
      return $this->controllerName;
    }
    public function getTemplateName(){
      return $this->controllerMethod;
    }

    public function setTemplate($template){
      if(file_exists(WWW_ROOT . "src/View/{$template}.php")){
        $this->templateToLoad = WWW_ROOT . "src/View/{$template}.php";
        return true;
      }
      return false;
    }

    public function getTemplate(){
      return $this->templateToLoad;
    }

    public function classExists($controllerName, $controllerMethod, $requestData, $template = null){
      if(is_string($controllerName)){
        if(class_exists($controllerName) && !empty($controllerName)){
          $this->controllerInstance = new $controllerName($requestData, $this);

          if(is_callable([$this->controllerInstance, $controllerMethod])){
            $this->controllerInstance->$controllerMethod();

            $this->setTemplate("{$this->controllerName}/{$controllerMethod}");
          }
          else{
            $this->setTemplate(null);
          }
        }
        return true;
      }
      return false;
    }

    public function requestMethodIs($requestMethod){
      if($_SERVER["REQUEST_METHOD"] === strtoupper($requestMethod)){
        return true;
      }
      return false;
    }

    public function setUriConfig($uri){
      if(is_string($uri) && !empty($uri)){
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

    public function loadTemplate(){
      if(is_file($_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'])){
        include $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'];
      } 
      else{
        if($this->setUriConfig($_SERVER["REQUEST_URI"])){
          if($this->requestMethodIs("POST")){
            $this->controllerInstance = NULL;

            $requestData = (object) $_POST;
            
            if(!$this->classExists(
              $this->controllerName."Controller", $this->controllerMethod, $requestData
            )){
              return false;
            }
          }
          else{
            $this->controllerInstance = NULL;

            $requestData = (object) $_GET;
            $template = "{$this->controllerName}/{$this->controllerMethod}";

            if(!$this->classExists(
              $this->controllerName."Controller", $this->controllerMethod, $requestData, $template
            )){
              return false;
            }
            else{
              include WWW_ROOT . "src/View/Default/default.php";         
              exit();
            }
          } 
          call_user_func_array([$this->controllerInstance, $this->controllerMethod], $this->controllerArgs);
        }
      }
    }
  }
?>