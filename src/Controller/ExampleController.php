<?php 
	namespace Controller;

	use Controller\AppController;
	use Simple\Mailer\Email;
	
	class ExampleController extends AppController{
		public function __construct()
		{
			parent::initialize();
		}

		public function isAuthorized(string $method)
		{
			return $this->alowedMethods($method, ["home"]);
		}

		public function home($id)
		{
			$Cadastro = $this->newEntity("Example");
			
			if($this->requestIs("GET") && !empty($id)){
					$Cadastro = $Cadastro->get($id);
					

					/*$Email = new Email();
		        	$Email->subject("Mensagem de Iza")
		            	->messageTemplate("emailDefault.html")
		            	->from("yadsondev@gmail.com", "Sri")
		            	->to("yadson20@gmail.com", "Yadson")
		            	->attachment("images/notebook.png");

		            if($Email->send()){
		            	$this->Flash->success("Email enviado");
		            	return $this->redirect(["controller" => "Sri", "view" => "home"]);
		            }
		            else{
		            	$this->Flash->error("Não enviado");
		            }*/
			}

			$this->viewTitle("Home");
			$this->set(["cadastro" => $Cadastro]);
		}
	}
