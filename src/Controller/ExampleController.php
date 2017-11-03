<?php  
	class ExampleController extends AppController{
		public function __construct($requestData){
			parent::initialize($requestData);
		}

		public function isAuthorized(string $method){
			return $this->notAlowed($method, ["home"]);
		}

		public function home($id){
			$this->viewTitle("Home");
		}
	}
