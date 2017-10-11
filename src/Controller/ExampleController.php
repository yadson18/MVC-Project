<?php  
	class ExampleController extends Controller{
		public function __construct($requestData, $templateSystem){
			parent::__construct($requestData, $templateSystem);
		}

		public function isAuthorized($method){
			return $this->notAlowed($method, [
				"home"
			]);
		}

		public function home(){
			$this->setPageTitle("Home");
			
			$user = ["name" => "Yadson"];
			
			$this->setViewData(["user" => $user, "data" => $user]);
			$this->flash("success", "A classe Flash está funcionando.");
		}
	}
?>