<?php 
    namespace Controller;

    use Simple\Controller\Controller;

	class AppController extends Controller
    {
		protected function initialize($requestData)
        {
            parent::initialize($requestData);

            $this->loadComponent("Session");
            $this->loadComponent("Flash");
            $this->loadComponent("Ajax");
        }

        protected function notAlowed(string $method, array $methods)
        {
            if(!empty($methods) && !empty($method)){
                if(in_array($method, $methods)){
                    return true;
                }
            }
            return false;
        }
	}