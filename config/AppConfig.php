<?php 
	Configurator::getInstance()
		
		->set("AppName", "Example Name - ")

		->set("Salt", "759403333bb1ee9a773e97f4d1d1b29baab207b5")
		
		->set("DisplayErrors", true)

		->set("DefaultErrorPage", VIEW."ErrorPages".DS."daniedAccess.php")

		->set("DefaultRoute", [
			"controller" => "Example",
			"view" => "home"
		])

		->set("EmailTransport", [
			"host" => "smtp.gmail.com",
			"port" => 587,
			"email" => "yadsondev@gmail.com",
			"password" => "yadsondado12",
			"security" => "tls"
		])

		->set("Databases", [
			"firebird" => [
				"SRICASH" => [
					"host" => "localhost",
					"path" => "/BD/SRICASH.FDB",
					"user" => "SYSDBA",
					"password" => "masterkey",
					"charset" => "UTF8"
				]
			]
		])

		->set("Webservice", [
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
		]);	