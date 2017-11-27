<?php 
	namespace Controller;
	
	class ExampleController extends AppController{
		public function __construct()
		{
			parent::initialize();
		}

		public function isAuthorized(string $method)
		{
			return $this->alowedMethods($method, ["home"]);
		}

		public function home()
		{
			$this->viewTitle("Home");
		}
	}
