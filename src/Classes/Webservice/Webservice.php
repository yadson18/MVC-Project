<?php
    class Webservice{
        private static $instance;
        private $connection;

        private function __construct(){
            try {
                if(!isset($this->connection)){
                    $contextOptions = [
                        "ssl"=>[
                            "verify_peer"=>false,
                            "verify_peer_name"=>false,
                            "crypto_method" => STREAM_CRYPTO_METHOD_TLS_CLIENT
                        ]
                    ];

                    $options = [
                        'soap_version'=>'SOAP_1_2',
                        'exceptions'=>true,
                        'trace'=>1,
                        'cache_wsdl'=>'WSDL_CACHE_NONE',
                        'stream_context' => stream_context_create($contextOptions)
                    ];
                    $this->connection = new SoapClient('Connection URL', $options);
                }
            } 
            catch (Exception $e) {
                echo "Não foi possível conectar-se ao Webservice.";
            }
        }
        
        public static function getInstance(){
            if(!isset(self::$instance)){
                self::$instance = new Webservice();
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