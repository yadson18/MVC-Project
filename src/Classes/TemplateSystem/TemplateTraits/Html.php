<?php  
    // A trait Html é usada para retornar textos e tags HTML específicos.
	trait Html{
        /* 
         * Este método retorna a tag script que carregará o Javascript na View.
         * (string) scriptName, nome do script que deverá ser retornado e carregado.
         */
		public function script($scriptName){
      		return "<script type='text/javascript' src='/webroot/js/$scriptName'></script>";
    	}

        /* 
         * Este método retorna a tag link que carregará o documento Css na View.
         * (string) cssName, nome da folha de estilo que deverá ser retornado e carregado.
         */
    	public function css($cssName){
      		return "<link rel='stylesheet' type='text/css' href='/webroot/css/$cssName'>";
    	}

        /*
         * O método daniedAccess, usará o buffer de saída do PHP, para retornar uma página,
         * de erro, caso o usuário não esteja permitido a acessar determinado conteúdo,
         * ou se a url digitada não existir no projeto.
         * (string) message, mensagem que será mostrada ao usuário.
         */
        public function daniedAccess($message){
            ob_start();
            include "src/View/FlashMessageTemplates/daniedAccess.php";
            echo ob_get_clean();
        }
	}
?>