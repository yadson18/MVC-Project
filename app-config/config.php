<?php  
	$appConfiguration = [
		"AppName" => "Nome do app",
		
		"Databases" => [
			"tipo da base de dados (Ex: mysql)" => [
				"nome da base de dados" => [
					"dbPath" => "caminho até a base de dados",
					"dbUser" => "usuário",
					"dbPassword" => "senha",
					"charset" => "codificação"
				]
			]
		],

		"ClassesPath" => [
			"Classes/Datasource", 
			"Classes/TemplateSystem",
			"Classes/TemplateSystem/TemplateTraits",
			"Classes/Webservice",
			"Controller", 
			"Controller/ControllerTraits"
		],

		"Webservice" => [
			"url" => "url do webservice",
			"options" => [
				"soap_version" => "SOAP_1_2",
                "exceptions" => true,
                "trace" => 1,
                "cache_wsdl" => "WSDL_CACHE_NONE",
                "stream_context" => stream_context_create([
                	"ssl" => [
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "crypto_method" => STREAM_CRYPTO_METHOD_TLS_CLIENT
                    ]
                ])
			]
		]
	];
?>