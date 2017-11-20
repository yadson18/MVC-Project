<?php 
	namespace Controller;

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
			$this->Cadastro = $this->newEntity("Example");
			
			if($this->requestIs("GET") && !empty($id)){
					$cadastro = $this->Cadastro->get(8002);
					$cadastro->razao = "ATUALIZADO";


					debug($cadastro->update());
					/*if($cadastro){
						$cadastro->razao = "ATUALIZADO";

						if($cadastro->update()){
							$this->Flash->success("O cadastro foi modificado com sucesso.");
						}
						else{
							$this->Flash->error("Não foi possível modificar.");
						}
					}
					else{
						$this->Flash->error("Não foi possível encontrar o cadastro.");
					}*/
					

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
			$this->set(["cadastro" => $cadastro]);
		}
	}
