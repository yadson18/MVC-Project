<?php  
	class UsersController extends Controller{
		public static function authorized($method, $loggedUser){
			$allowedMethods = ["login", "logout"];

			return self::authorizedToAccess($method, $allowedMethods, $loggedUser);
		}

		public function login(){
			if($this->requestMethodIs("POST")){
				$webservice = new Webservice();
				$result = $webservice->postRequest([
					"mod" => "login",
					"comp" => 5,
					"user" => $_POST["usuario"],
					"pass" => $_POST["senha"]
				], false);

				if(isset($result["success"]) && isset($result["C"])){
					if($result["success"] == 1 && !empty($result["C"])){
						$this->isAuthorized();
						$result["C"]["p"] = base64_encode($_POST["senha"]);
						$this->serializeData(["User" => $result["C"]]);
						return $this->redirectTo(["controller" => "AverbePorto"]);
					}
				}
				$this->flashError("Usuário ou senha incorreto, tente novamente.");
				return $this->redirectTo(["controller" => "Users", "view" => "login"]);
			}

			return $this->serializeData([
				"user" => "loginn",
				"pass" => "123"
			]);
		}

		public function logout(){
			if($this->requestMethodIs("GET")){
				$this->isNotAuthorized();
				return $this->redirectTo(["controller" => "Users", "view" => "login"]);
			}
		}

		public function isAuthorized(){
			$this->serializeData(["Logged" => true]);
		}


		public function isNotAuthorized(){
			$this->sessionDestroy();
		}

		public static function checkLoggedUser(){
			if(isset($_SESSION["logged"])){
				if($_SESSION["logged"] === false){
					self::isNotAuthorized();
				}
			}
			else{
				self::isNotAuthorized();
			}
		}
	}
?>