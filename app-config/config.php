<?php  
	$appConfiguration = [
		"AppName" => "Framework ILP - ",
		
		"DefaultRoute" => [
			"controller" => "Example",
			"view" => "home"
		],

		"DefaultErrorPage" => [
			"pagePath" => ""
		],

		"Databases" => [
			"dbTypeExample" => [
				"dbNameExample" => [
					"dbPath" => "/BD/EXAMPLE.FDB",
					"dbUser" => "SYSDBA",
					"dbPassword" => "masterkey",
					"charset" => "UTF8"
				]
			]
		],

		"ClassesPath" => [
			"Classes/Datasource", 
			"Classes/TemplateSystem",
			"Classes/TemplateSystem/TemplateTraits",
			"Classes/Webservice",
			"Controller", 
			"Controller/Interfaces",
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