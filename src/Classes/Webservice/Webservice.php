<?php
    class Webservice{
        private static $instance;
        private $connection;

        private function __construct($webserviceConfig){
            try {
                if(!isset($this->connection)){
                    $this->connection = new SoapClient($webserviceConfig["url"], $webserviceConfig["options"]);
                }
            } 
            catch (Exception $e) {
                echo "Não foi possível conectar-se ao Webservice.";
            }
        }
        
        public static function getInstance(){
            if(!isset(self::$instance)){
                self::$instance = new Webservice(getWebServiceConfig());
            }
            return self::$instance;
        }

        public function criaAmbiente($arguments){
            return $this->callFunction("criaAmbiente", $arguments);
        }

        public function callFunction($functionName, $arguments){
            if(is_callable([$this->connection, $functionName], true)){
                $result = $this->connection->$functionName($arguments);

                if(empty($result["erro"]) && $result["return"] === 1){
                    return true;
                }
            }
            return false;
        }
    }
?>