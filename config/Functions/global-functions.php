<?php
	function debug($data){
		$debugData = print_r($data, true);
		echo "<pre id='debug-screen'>{$debugData}</pre>";
	}