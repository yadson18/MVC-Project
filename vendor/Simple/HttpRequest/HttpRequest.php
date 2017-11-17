<?php 
	namespace Simple\HttpRequest;

	class HttpRequest
	{
		private $requestType;
		private $requestData;

		public function __construct(){
			$this->setRequestType($_SERVER["REQUEST_METHOD"]);

			if ($this->is("POST")) {
				$this->setRequestData($_POST);
			}
			else if ($this->is("GET")) {
				$this->setRequestData($_GET);	
			}
		}

		protected function setRequestType(string $requestType)
		{
			if (!empty($requestType)) {
				$this->requestType = $requestType;
			}
		}
		public function getType()
		{
			return $this->requestType;
		}

		protected function setRequestData(array $requestData)
		{
			$this->requestData = (object) $requestData;
		}
		public function getData()
		{
			return $this->requestData;	
		}

		public function is(string $requestType)
		{
			if ($this->requestType === strtoupper($requestType)) {
				return true;
			}
			return false;
		}
	}