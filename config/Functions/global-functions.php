<?php
	function debug($data){
		$debugData = print_r($data, true);
		echo "<pre id='debug-screen'>{$debugData}</pre>";
	}

	function requestIs(string $requestMethod){
		if(!empty($requestMethod)){
			if($_SERVER["REQUEST_METHOD"] === strtoupper($requestMethod)){
	            return true;
	        }
		}
        return false;
	}