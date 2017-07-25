<?php  
	class AverbePortoController extends Controller{
		public function isAuthorized($method, $user){
			$allowedMethods = [];

			return $this->authorizedToAccess($method, $allowedMethods, $user);
		}

		public function index(){
			$this->setTitle("Home");
		}

		public function getAuthorizedUser($connection){
			$result = $connection->postRequest([
				"user" => $this->getLoggedUser("userName"),
				"pass" => $this->getLoggedUser("pass"),
				"mod" => "login",
				"comp" => 5
			], true);

			if(!empty($result["C"])){
				return true;
			}
			return false;
		}

		public function sendFile(){
			if($this->requestMethodIs("POST")){
				$file = tmpfile();
				fwrite($file, file_get_contents($_FILES["file"]["tmp_name"]));
				rewind($file);
				$meta = stream_get_meta_data($file);

	            $fileName = $meta["uri"];
	            $fileType = mime_content_type($meta["uri"]);
	            $fileSize = filesize($meta["uri"]);
	            $postFile = new CURLFile($fileName, $fileType, "file");

	            $webservice = Webservice::getInstance();

	            if($this->getAuthorizedUser($webservice)){
		            $result = $webservice->postRequest([
		            	"file" => $postFile,
		                "fileSize" => $fileSize,
		                "comp" => 5,
		                "mod" => "Upload",
		                "path" => "eguarda/php/",
		                "recipient" => ""
		            ], true);

		            if(!empty($result)){
		            	if(isset($result["success"]) && $result["success"] === 1){
		            		if(isset($result["S"]) && !empty($result["S"])){
		            			if($result["S"]["P"] === 1){
		            				$this->flash("Success", "O arquivo foi salvo com sucesso.");
		            			}
		            			elseif($result["S"]["D"] === 1){
		            				$this->flash("Error", "Não foi possível salvar, arquivo pré-existente.");

		            			}
			            		elseif($result["S"]["R"] === 1){
			            			$this->flash("Error", "O arquivo enviado não parece ser do tipo certo.");
		            			}
		            			elseif($result["S"]["N"] === 1){
		            				$this->flash("Error", "O arquivo enviado não é um XML ou ZIP válido.");
		            			}
		            			else{
		            				if(isset($result["error"])){
		            					$this->flash("Error", "XML ou ZIP não encontrado.");
		            				}
		            			}
		            		}
			            	return $this->redirectTo([
			            		"controller" => "AverbePorto", 
			            		"view" => "sendFile"
			            	]);
		            	}
		            	$this->flash("Error", "Ocorreu um erro na comunicação com o Web Service.");
		            	return $this->redirectTo([
		            		"controller" => "AverbePorto", 
		            		"view" => "sendFile"
		            	]);
		            }
		            $this->flash("Error", "Por favor, confira se o arquivo selecionado é XML ou ZIP.");
		            return $this->redirectTo([
		            	"controller" => "AverbePorto", 
		            	"view" => "sendFile"
		            ]);
	            }
				
			}
			$this->setTitle("Envio de arquivo");
		}
	}
?>