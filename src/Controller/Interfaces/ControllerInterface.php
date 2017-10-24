<?php  
	interface ControllerInterface{
		public function setViewData(array $variables, array $variablesToSerialize = null);

		public function setPageTitle(string $title);

		public function newEntity(string $className);

		public function requestIs(string $requestMethod);

		public function flash(string $messageType, string $messageText);

		public function notAlowed(string $method, array $methods);

		public function redirect(array $url);

		public function isAuthorized(string $method);
	}