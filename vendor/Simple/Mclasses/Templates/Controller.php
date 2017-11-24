<?php 
	namespace Controller;

	class %controller_name%Controller extends AppController
	{
		public function __construct()
		{
			parent::initialize();
		}

		public function isAuthorized(string $method)
		{
			return $this->alowedMethods($method, []);
		}
	}