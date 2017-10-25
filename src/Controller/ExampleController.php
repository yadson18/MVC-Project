<?php  
	class ExampleController extends Controller{
		public function __construct($requestData, $templateSystem){
			parent::__construct($requestData, $templateSystem);
		}

		public function isAuthorized(string $method){
			return $this->notAlowed($method, [
				"home", "logStatus"
			]);
		}

		public function home(){
			$cliente = $this->newEntity("Cliente");

			if($this->requestIs("POST")){
				$cliente->get(1);
				$this->flash("success", "A classe Flash está funcionando.");
				
				//return $this->redirect(["controller" => "User", "view" => "home"]);
			}
			
			$this->setViewData(["cliente" => $cliente]);
			$this->setPageTitle("Home");
		}

		public function logStatus(){
			if($this->requestIs("POST")){
				$this->ajaxResponse([
					"status" => "success",
					"message" => "dados retornados"
				]);
			}
		}
	}