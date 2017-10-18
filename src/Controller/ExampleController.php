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
			$cliente = $this->newEntity("Cliente")->get(1);

			$this->setPageTitle("Home");
			$this->flash("success", "A classe Flash está funcionando.");
			$this->setViewData(["cliente" => $cliente]);
		}
	}
?>