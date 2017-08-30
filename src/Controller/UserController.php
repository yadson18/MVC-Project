<?php  
	class UserController extends Controller{
		private $usuariosDB;

		public function __construct($requestData, $templateSystem){
			parent::__construct($requestData, $templateSystem);
			$this->usuariosDB = new DatabaseConnect(getDatabaseConfig("firebird", "users"));
		}

		public function isAuthorized($method, $user){
			$allowedMethods = ["login"];

			return $this->authorizedToAccess($method, $allowedMethods, $user);
		}

		public function login(){
			if($this->requestMethodIs("POST")){
				$postData = explode("&", $_POST["dados"]);
				foreach($postData as $values) {
					$values = explode("=", $values);
					
					$loginData[$values[0]] = $values[1];
				}

				if(empty($loginData["login"]) || empty($loginData["senha"])){
					$response = [
						"loginSuccess" => false,
						"message" => [
							"type" => "error"
						],
						"redirectTo" => "/Sri/home"
					];

					if(empty($loginData["login"]) && empty($loginData["senha"])){
						$response["message"]["text"] = "Por favor, digite o nome do usuário e a senha.";
					}
					else if(!empty($loginData["login"]) && empty($loginData["senha"])){
						$response["message"]["text"] = "Por favor, digite sua senha.";
					}
					else if(empty($loginData["login"]) && !empty($loginData["senha"])){
						$response["message"]["text"] = "Por favor, digite o nome do usuário.";
					}
				}
				else{
					$condition = "WHERE LOGIN = ? AND SENHA = ?";
					$result = $this->usuariosDB->select("*", "COLABORADOR", $condition, [
						$loginData["login"], 
						$loginData["senha"]
					]);

					if(!empty($result) && array_key_exists("COD_CADASTRO", $result[0])){
						$this->setLoggedUser($result);
						$response = [
							"loginSuccess" => true, 
							"redirectTo" => "/Cotacao/home"
						];
					}
					else{
						$response = [
							"loginSuccess" => false, 
							"message" => [
								"type" => "error",
								"text" => "Nome de usuário ou senha incorretos."
							],
							"redirectTo" => "/Sri/home"
						];
					}
				}

				echo json_encode($response);
			}
		}

		public function logout(){
			if($this->requestMethodIs("GET")){
				$this->destroyAllData();
				return $this->redirectTo(["controller" => "Sri", "view" => "index"]);
			}
		} 
	}
?>