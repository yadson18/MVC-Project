<?php
	function debug($data)
	{
		echo "<pre id='debug-screen'>";
		var_dump($data);
		echo "</pre>";
	}

	function requestIs(string $requestMethod)
	{
		if ($_SERVER["REQUEST_METHOD"] === strtoupper($requestMethod)) {
	        return true;
	    }
        return false;
	}

	function isInstanceOf($objectInstance, string $className)
	{
		if (is_object($objectInstance) && get_class($objectInstance) === $className) {
			return true;
		}
		return false;
	}

	function removeSpecialChars($string) 
	{
	    $string = str_replace(["á","à","â","ã","ä"], "a", $string);
	    $string = str_replace(["Á","À","Â","Ã","Ä"], "A", $string);
	    $string = str_replace(["é","è","ê"], "e", $string);
	    $string = str_replace(["É","È","Ê"], "E", $string);
	    $string = str_replace(["í","ì"], "i", $string);
	    $string = str_replace(["Í","Ì"], "I", $string);
	    $string = str_replace(["ó","ò","ô","õ","ö"], "o", $string);
	    $string = str_replace(["Ó","Ò","Ô","Õ","Ö"], "O", $string);
	    $string = str_replace(["ú","ù","ü"], "u", $string);
	    $string = str_replace(["Ú","Ù","Ü"], "U", $string);
	    $string = str_replace("ç", "c", $string);
	    $string = str_replace("Ç", "C", $string);
	    $string = str_replace([
	    	"[","]",">","<","}","{",")","(",":",";",",","!","?","*","%","~","^","`","@"
	    ], "", $string);
	    
	    return $string;
	}