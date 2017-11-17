<?php 
	namespace Simple\Controller;

	use Simple\Components\Component;

	abstract class Controller
	{
		protected $RequestData;
		private $viewTitle;
		private $viewData;

		protected function initialize($requestData)
		{
			$this->RequestData = $requestData;
		}

        protected function loadComponent(string $componentName)
        {
            $Component = new Component($componentName);

            $this->$componentName = $Component->load();
        }

		protected function set(array $variables, array $variablesToSerialize = null)
		{
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
                            if($this->Session->findData($variableName)){
                             	$this->Session->removeData($variableName);
                            }
                            $this->viewData[$variableName] = $value;
                        }
                    }
                }
            }
        }
        public function getviewData()
        {
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

        protected function viewTitle(string $title)
        {
            if(!empty($title)){
                $this->viewTitle = $title;
            }
        }
        public function getViewTitle()
        {
        	return $this->viewTitle;
        }

		protected function newEntity(string $className)
		{
            if(!empty($className)){
                $Entity = "Model\\Entity\\{$className}";

                if(class_exists($Entity)){
                    return new $Entity();
                }
	      	}
	      	return false;
	    }

		protected function requestIs(string $requestMethod){
			return requestIs($requestMethod);
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