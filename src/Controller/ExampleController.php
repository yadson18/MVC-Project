<?php  
	class ExampleController extends AppController{
		public function __construct($requestData){
			parent::initialize($requestData);
		}

		public function isAuthorized(string $method){
			return $this->notAlowed($method, ["home"]);
		}

		public function home(){
			$Cliente = $this->newEntity("Cliente");

			if($this->requestIs("POST")){
				$Cliente = $Cliente->get(88);
				$this->Flash->info("A classe Flash está funcionando.");
				//return $this->redirect(["controller" => "User", "view" => "home"]);
			}
			$this->set(["cliente" => $Cliente]);
			$this->pageTitle("Home");
		}
	}
