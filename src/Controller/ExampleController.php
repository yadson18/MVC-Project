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
				//$Cadastro = $Cadastro->get(88);
				if(!empty($id)){
					$Email = new Email("default");
	            	$Email->subject("test")
	                	->messageTemplate("emailDefault.html")
	                	->from("yadsondev@gmail.com", "Sri")
	                	->to("yadson20@gmail.com", "Yadson")
	                	->attachment("images/notebook.png");

	                if($Email->send()){
	                	$this->Flash->success("Email enviado");
	                }
				}

			}

			$this->viewTitle("Home");
			$this->set(["cadastro" => $Cadastro]);
		}
	}
