<?php  
	/*
	 * Arquivo de configuração da aplicação.
	 *	(array) appConfiguration, é um array, onde encontram-se as configurações que o sistema usará.
	 *		[AppName] -> Título da aplicação.
	 *		[DefaultRoute] -> O primeiro Controller e View a serem carregados ao iniciar a aplicação.
	 *		[Salt] -> String aleatória para criar hash de senha.
	 *		[DefaultErrorPage] -> Página que sempre será exibida em caso de acesso não permitido ou url's inexistentes.
	 *		[Databases] -> Bases de dados que serão usadas pela aplicação.
	 *		[ClassesPath] -> Diretórios onde encontram-se as classes do sistema, para que possam ser carregadas.
	 *		[Webservice] -> Configuração para comunicação com webservices.
	 */

	$appConfiguration = [
		"AppName" => "Example Name - ",
		
		"DefaultRoute" => [
			"controller" => "Example",
			"view" => "home"
		],

		"Salt" => "759403333bb1ee9a773e97f4d1d1b29baab207b5",

		"DefaultErrorPage" => "daniedAccess.php",

		"Databases" => [
			"database Type" => [
				"database name" => [
					"dbPath" => "/var/dbExample",
					"dbUser" => "root",
					"dbPassword" => "123",
					"charset" => "UTF8"
				]
			]
		],

		"Webservice" => [
			"url" => "urlExample.com/soap",
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