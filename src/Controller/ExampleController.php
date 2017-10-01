<?php  
	class ExampleController extends Controller{
		public function __construct($requestData, $templateSystem){
			parent::__construct($requestData, $templateSystem);
		}

		public function isAuthorized($method, $user){
			$allowedMethods = ["home"];

			return $this->authorizedToAccess($method, $allowedMethods, $user);
		}

		public function home(){
			$this->setPageTitle("Home");
			$this->setViewData([
				0 => ["yadson", 18],
				0 => ["a", "b", "c"]
			]);
		}
	}
?>