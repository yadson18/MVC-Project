<?php  
	interface ControllerInterface{
		public function setViewData($variables, $variablesToSerialize = null);

		public function setPageTitle($title);

		public function newEntity($className);

		public function requestIs($requestMethod);

		public function flash($messageType, $messageText);

		public function notAlowed($method, $methods);

		public function redirect($url);

		public function isAuthorized($method);
	}