<?php  
	class UsersController extends Controller{
		public function isAuthorized($method, $user){
			$allowedMethods = ["login"];

			return $this->authorizedToAccess($method, $allowedMethods, $user);
		}

		public function login(){
			if($this->requestMethodIs("POST")){
				$webservice = Webservice::getInstance();
				$result = $webservice->postRequest([
					"mod" => "login",
					"comp" => 5,
					"user" => $_POST["usuario"],
					"pass" => $_POST["senha"]
				], false);

				if(isset($result["success"]) && isset($result["C"])){
					if($result["success"] == 1 && !empty($result["C"])){
						$result["C"]["pass"] = $_POST["senha"];
						
						$this->setLoggedUser($result["C"]);
						return $this->redirectTo(["controller" => "AverbePorto"]);
					}
				}
				$this->flash("Error", "Usuário ou senha incorreto, tente novamente.");
				return $this->redirectTo(["controller" => "Users", "view" => "login"]);
			}

			$this->setTitle("Login");
		}

		public function logout(){
			if($this->requestMethodIs("GET")){
				$this->destroyAllData();
				return $this->redirectTo(["controller" => "Users", "view" => "login"]);
			}
		}
	}
?>