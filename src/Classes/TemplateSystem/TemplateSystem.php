<?php 
  class TemplateSystem{
    use Html;
    use Session;
    use Flash;

    private $templateToLoad;
    private $classInstance;
    private $viewVars;
    private $topViewVars;

    private function __construct(){
      $this->viewVars = [];
      $this->topViewVars = 0;
    }

    public static function getInstance(){
      if(!self::getData("object")){
        self::saveData(["object" => new TemplateSystem()]);
      }
      return self::getData("object");
    }

    public function fetchAll(){ 
      if(is_file($this->getTemplate())){
        if($this->getLoggedUser() && $this->getTitle() === "Login"){
          header("Location: /AverbePorto/index");
        }
        else{
          ob_start();
          if(!empty(self::getInstance()->getViewVars())){
            foreach(self::getInstance()->getViewVars() as $variable){
              foreach($variable as $variableName => $value){
                ${$variableName} = $value;
              }
            }
          }

          include $this->getTemplate();
          return ob_get_clean();
        }
      }
    } 

    public function setTitle($title){
      $this->setViewVars(["title" => $title]);
    }

    public function getTitle(){
      return $this->getViewVars("title");
    }

    public function setLoggedUser($user){
      $this->setViewVars(["user" => $user]);
    }

    public function getLoggedUser($index = null){
      if(!empty($this->getViewVars("user"))){
        if(empty($index)){
          return $this->getViewVars("user");
        }
        else{
          if(array_key_exists($index, $this->getViewVars("user"))){
            return $this->getViewVars("user")[$index];
          }
        }
      }
      return false;
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

    public function setViewVars($data){
      if(!empty($data)){
        if(is_array($data)){
          foreach($data as $variableName => $value){
            if(!empty($variableName)){
              $varExists = self::getInstance()->getVarIndex($variableName);
              if($varExists !== false){
                self::getInstance()->viewVars[$varExists][$variableName] = $value;
              }
              else{
                self::getInstance()->viewVars[self::getInstance()->topViewVars++] = [$variableName => $value];
              }
            }
            else{
              return false;
            }
          }
          return true;
        }
      }
      return false;
    }

    public function getVarIndex($variableName){
      for($i = 0; $i < sizeof(self::getInstance()->getViewVars()); $i++){
        if(isset(self::getInstance()->getViewVars()[$i][$variableName])){
          return $i;
        }
      }
      return false;
    }

    public function getViewVars($index = null){
      if(!empty(self::getInstance()->viewVars)){
        if(!empty($index)){
          foreach(self::getInstance()->viewVars as $variable){
            if(array_key_exists($index, $variable)){
              return $variable[$index];
            }
          }
          return false;
        }
        else{
          return self::getInstance()->viewVars;
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
          $this->classInstance = new $controller($requestData, self::getInstance());
          if($this->authorizedUser($method)){
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
              return false;
            }
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

    public function getArgsControllerMethod($uri){
      if(is_string($uri) && !empty($uri)){
        $args = explode("/", substr($uri, 1));
        $controller = array_shift($args);
        $method = array_shift($args);

        if(is_null($controller)){
          $controller = "";
        }
        $controller = ucfirst($controller)."Controller";
        if(is_null($method) || $method == ""){
          if($controller === "Controller"){
            $controller = "UsersController";
            $method = "login";
          }
          else{
            $method = "index";
          }
        }

        return [
          "args" => $args,
          "controller" => $controller,
          "method" => $method
        ];
      }
      return false;
    }

    public function authorizedUser($method){
      if($this->classInstance->isAuthorized($method, $this->getLoggedUser())){
        return true;
      }
      return false;
    }

    public function loadTemplate($template){
      if (is_file($_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'])) {
        include $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'];
      } 
      else{
        $values = $this->getArgsControllerMethod($_SERVER["REQUEST_URI"]);
        $args = $values["args"];
        $controller = $values["controller"];
        $method = $values["method"];

        if($this->requestMethodIs("POST")){
          $this->classInstance = NULL;
          $requestData = (object) $_POST;
          
          if(!$this->classExists($controller, $method, $requestData)){
            $this->flashDaniedAccess(
              "Você não está autorizado a acessar esta página, confira se o usuário está logado ou se a URL foi digitada corretamente."
            );
            return false;
          }
        }
        else{
          $this->classInstance = NULL;
          $requestData = (object) $_GET;
          
          if(!$this->classExists($controller, $method, $requestData, $template)){
            $this->flashDaniedAccess(
              "Você não está autorizado a acessar esta página, confira se o usuário está logado ou se a URL foi digitada corretamente."
            );
            return false;
          }
          else{
            if($this->authorizedUser($method)){
              if(!empty(self::getInstance()->getViewVars())){
                foreach(self::getInstance()->getViewVars() as $variable){
                  foreach($variable as $variableName => $value){
                    ${$variableName} = $value;
                  }
                }
              }

              include WWW_ROOT . "src/View/Default/default.php";         
              exit();
            }
            else{
              $this->flashDaniedAccess(
                "Você não está autorizado a acessar esta página, confira se o usuário está logado
                ou se a URL foi digitada corretamente."
              );
            }
          }
        } 
        call_user_func_array([$this->classInstance, $method], $args);
      }
    }
  }
?>