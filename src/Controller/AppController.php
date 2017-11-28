<?php 
    namespace Controller;

    use Simple\Controller\Controller;

	class AppController extends Controller
    {
		protected function initialize()
        {
            parent::initialize();

            $this->loadComponent("Session");

            $this->loadComponent("Flash");

            $this->loadComponent("Ajax");
        }

        protected function alowedMethods(string $method, array $methods)
        {
            if(in_array($method, $methods)){
                return true;
            }
            return false;
        }
	}