<?php  
	class ExampleController extends AppController{
		public function __construct($requestData){
			parent::initialize($requestData);
		}

		public function isAuthorized(string $method){
			return $this->notAlowed($method, ["home"]);
		}

		public function home($id){
			$Cadastro = $this->newEntity("Example");

			if($this->requestIs("GET")){
				$Cadastro = $Cadastro->get($id);
			}

			$this->viewTitle("Home");
			$this->set(["cadastro" => $Cadastro]);
		}
	}
