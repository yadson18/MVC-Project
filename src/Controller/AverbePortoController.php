<?php  
	class AverbePortoController extends Controller{
		public static function authorized($method, $loggedUser){
			$allowedMethods = [];

			return self::authorizedToAccess($method, $allowedMethods, $loggedUser);
		}

		public function index(){
			$this->serializeData(["Title" => "Home"]);
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

	            $webservice = new Webservice();
	            $user = $_SESSION[Session::getId()]["User"];
				$webservice->postRequest([
					"user" => $user["userName"],
					"pass" => base64_decode($user["p"]),
					"mod" => "login",
					"comp" => 5
				], true);
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
	            				$this->flashSuccess("O arquivo foi salvo com sucesso.");
	            			}
	            			elseif($result["S"]["D"] === 1){
	            				$this->flashError("Não foi possível salvar, arquivo pré-existente.");
	            			}
		            		elseif($result["S"]["R"] === 1){
	            				$this->flashError("O arquivo enviado não parece ser do tipo certo.");
	            			}
	            			elseif($result["S"]["N"] === 1){
	            				$this->flashError("O arquivo enviado não é um XML ou ZIP válido.");
	            			}
	            			else{
	            				if(isset($result["error"])){
	            					$this->flashError("XML ou ZIP não encontrado.");
	            				}
	            			}
	            		}
		            	return $this->redirectTo([
		            		"controller" => "AverbePorto", 
		            		"view" => "sendFile"
		            	]);
	            	}
	            	$this->flashError("Ocorreu um erro na comunicação com o Web Service.");
	            	return $this->redirectTo([
	            		"controller" => "AverbePorto", 
	            		"view" => "sendFile"
	            	]);
	            }
	            $this->flashError("Por favor, confira se o arquivo selecionado é XML ou ZIP.");
	            return $this->redirectTo([
	            	"controller" => "AverbePorto", 
	            	"view" => "sendFile"
	            ]);
			}
			//$this->serializeData(["Title" => "Envio de arquivo"]);
		}
	}
?>