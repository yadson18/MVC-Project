<?php 
	// Incluindo o arquivo "routes", que contém as constantes de rotas para os diretórios do sistema. 
	include "../config/AppRoutes.php";

	// Incluindo a classe AutoLoad, que carrega os namespaces baseados nos diretórios. 
	require_once VENDOR."AutoLoad.php";

	AutoLoad::getInstance()->loadNameSpaces();
	
	// Incluindo o arquivo "index.php", que encontra-se na raiz do projeto.
	include ROOT . DS . "index.php";