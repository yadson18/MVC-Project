<?php  
	$appConfiguration = [
		"AppName" => "Framework ILP",
		
		"DefaultRoute" => [
			"controller" => "Example",
			"view" => "home"
		],

		"Databases" => [
			"dbTypeExample" => [
				"dbNameExample" => [
					"dbPath" => "/BD/EXAMPLE.FDB",
					"dbUser" => "example",
					"dbPassword" => "secret",
					"charset" => "utf-8"
				]
			]
		],

		"ClassesPath" => [
			"Classes/Datasource", 
			"Classes/TemplateSystem",
			"Classes/TemplateSystem/TemplateTraits",
			"Classes/Webservice",
			"Controller", 
			"Controller/ControllerTraits",
			"Model",
			"Model/Interfaces"
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