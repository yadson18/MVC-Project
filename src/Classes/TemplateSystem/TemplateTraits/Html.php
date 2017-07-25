<?php  
    // A trait Html é usada para retornar textos e tags HTML específicos.
	trait Html{
        /* 
         * Este método retorna a tag script que carregará o Javascript na View.
         *
         *  (string) scriptName, nome do script que deverá ser retornado e carregado.
         */
		public function script($scriptName){
      		return "<script type='text/javascript' src='/js/$scriptName'></script>";
    	}

        /* 
         * Este método retorna a tag link que carregará o documento Css na View.
         *  
         *  (string) cssName, nome da folha de estilo que deverá ser retornado e carregado.
         */
    	public function css($cssName){
      		return "<link rel='stylesheet' type='text/css' href='/css/$cssName'>";
    	}
	}
?>