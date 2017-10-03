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
			$this->setViewData([
				"user" => [
					"name" => "Yadson"
				]
			]);
			$this->flash("success", "A classe Flash está funcionando.");
		}
	}
?>