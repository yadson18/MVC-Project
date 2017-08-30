<?php  
	class SriController extends Controller{
		public function __construct($requestData, $templateSystem){
			parent::__construct($requestData, $templateSystem);
		}

		public function isAuthorized($method, $user){
			$allowedMethods = ["index"];

			return $this->authorizedToAccess($method, $allowedMethods, $user);
		}

		public function index(){
			$this->setTitle("Início");
		}
	}
?>