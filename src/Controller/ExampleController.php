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
			
			$example = $this->newEntity("Example");
			echo "<br><br><br><br><br>";
			debug(
				$example->find("*")
					->where(["cod_cadastro >" => 10])
					->limit("max")
			);


			$user = [
				"name" => "Yadson"
			];

			$this->flash("success", "A classe Flash está funcionando.");
			$this->setViewData([
				"user" => $user, 
				"data" => $user, 
				"example" => $example
			]);
		}
	}
?>