<?php  
	interface ControllerInterface{
		public function isAuthorized($method);

		public function setViewData($variables);

		public function setPageTitle($title);

		public function requestMethodIs($requestMethod);

		public function flash($messageType, $messageText);

		public function redirectTo($url);

		public function notAlowed($method, $methods);
	}
?>