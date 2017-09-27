<?php  
	class ExampleController extends Controller{
		public function __construct($requestData){
			parent::__construct($requestData);
		}

		public function isAuthorized($method, $user){
			$allowedMethods = ["home"];

			return $this->authorizedToAccess($method, $allowedMethods, $user);
		}

		public function home(){}
	}
?>