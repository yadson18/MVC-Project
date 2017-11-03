<?php 
	abstract class AppController{
		private $viewTitle;
		private $viewData;
		protected $RequestData;

		public function initialize(stdClass $requestData){
			$this->loadModule("Session");
            $this->loadModule("Ajax");
            $this->loadModule("Flash");
            
			$this->RequestData = $requestData;
		}

		protected function set(array $variables, array $variablesToSerialize = null){
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

        protected function viewTitle(string $title){
            if(!empty($title)){
                $this->viewTitle = $title;
            }
        }
        public function getViewTitle(){
        	return $this->viewTitle;
        }

		protected function loadModule(string $module){
            if(file_exists(VENDOR . "Modules/{$module}.php") && class_exists($module)){
                $this->$module = new $module();
            }
        }

		protected function newEntity(string $className){
	     	if(!empty($className)){
	        	$className = ucfirst($className);
	        	
	        	if(class_exists($className)){
	          		return new $className();
	        	}
	      	}
	      	return false;
	    }

		protected function requestIs(string $requestMethod){
			return requestIs($requestMethod);
	    }

		protected function notAlowed(string $method, array $methods){
			if(!empty($methods) && !empty($method)){
				if(in_array($method, $methods)){
					return true;
				}
			}
			return false;
		}

		protected function redirect(array $url){
			if(!empty($url)){
				if(!isset($url["controller"]) && isset($url["view"]) && !empty($url["view"])){
					if(self::$TemplateSystem->Controller->getMethod() !== $url["view"]){
						return [
							"redirectTo" => "/".self::$TemplateSystem->Controller->getName()."/{$url['view']}"
						];
					}
				}
				else if(isset($url["controller"]) && isset($url["view"])){
					if(!empty($url["controller"]) && !empty($url["view"])){
						return ["redirectTo" => "/{$url['controller']}/{$url['view']}"];
					}
				}
			}
			return false;
		}
	}