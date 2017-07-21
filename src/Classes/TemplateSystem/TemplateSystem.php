<?php 
  class TemplateSystem{
    use Html;

    private $templateToLoad;
    private $classInstance;
    private $viewVars;

    public function fetchAll(){ 
      if(is_file($this->getTemplate())){
        ob_start();

        foreach($this->getViewVars() as $variableName => $value) {
            ${$variableName} = $value;
        }

        include $this->getTemplate();
        return ob_get_clean();
      }
    } 

    public function setTemplate($template){
      $this->templateToLoad = "src/View/{$template}.php";
    }

    public function getTemplate(){
      return $this->templateToLoad;
    }

    public function setViewVars($data){
      if(!empty($data)){
        if(is_array($data)){
          $this->viewVars = $data;
          return true;
        }
      }
      return false;
    }

    public function getViewVars($index = null){
      if(!empty($this->viewVars)){
        if(!empty($index)){
          if(array_key_exists($index, $this->viewVars)){
            return $this->viewVars[$index];
          }
          return false;
        }
        else{
          return $this->viewVars;
        }
      }
      return false;
    }

    public function getViewName($controller){
      if(!empty($controller) && is_string($controller)){
        return explode("Controller", $controller)[0];
      }
      return false;
    }

    public function classExists($controller, $method, $requestData, $template = null){
      if(class_exists("{$controller}")){
        if(strcmp($controller, "Controller") != 0){
          $this->classInstance = new $controller($requestData, $this);
          if(is_callable([$this->classInstance, $method])){
            if($this->setViewVars($this->classInstance->$method())){
              if($this->getViewVars("redirectTo")){
                header("Location: {$this->getViewVars('redirectTo')}");
              }
              else{
                $this->setTemplate("{$this->getViewName($controller)}/{$method}");
              }
            }
            else{
              $this->setTemplate("{$this->getViewName($controller)}/{$method}");
            }
          }
          else{
            echo "Erro 1";
          }
        }
        else if(
          (strcmp($controller, "Controller") == 0) && 
          (strcmp($method, "index") == 0)
        ){
          $values = explode("/", $template);  
          $controller = "{$values[0]}Controller";
          $method = $values[1];
          $this->classInstance = new $controller($requestData, $this);
          if(is_callable([$this->classInstance, $method])){
            $this->setViewVars($this->classInstance->$method());  
            $this->setTemplate($template);
          }
        }
        else{
          $this->setTemplate(null);
        }
        return true;
      }
      return false;
    }

    public function requestMethodIs($requestMethod){
      if(strcmp($_SERVER["REQUEST_METHOD"], $requestMethod) == 0){
        return true;
      }
      return false;
    }

    public function getValues($uri){
      if(is_string($uri) && !empty($uri)){
        $args = explode("/", substr($uri, 1));
        $controller = array_shift($args);
        $method = array_shift($args);

        if(is_null($controller)){
          $controller = "";
        }
        $controller = ucfirst($controller)."Controller";
        if(is_null($method) || $method == ""){
          $method = "index";
        }

        return [
          "args" => $args,
          "controller" => $controller,
          "method" => $method
        ];
      }
      return false;
    }

    public function loadTemplate($template){
      if (is_file($_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'])) {
        include $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'];
      } 
      else{
        $values = $this->getValues($_SERVER["REQUEST_URI"]);
        $args = $values["args"];
        $controller = $values["controller"];
        $method = $values["method"];

        if($this->requestMethodIs("POST")){
          $this->classInstance = NULL;
          $requestData = (object) $_POST;
          
          if(!$this->classExists($controller, $method, $requestData)){
            echo "Erro 3";
          }
        }
        else{
          $this->classInstance = NULL;
          $requestData = (object) $_GET;
          
          if(!$this->classExists($controller, $method, $requestData, $template)){
            echo "Erro 4";
          }
          
          include "src/View/Default/default.php";         
          exit();
          call_user_func_array([$this->classInstance, $method], $args);
        }
      }
    }
  }
?>