<?php  
	class Ajax{
		private $responseData = [
			"status" => "error",
			"message" => "Danied access for this method"
		];

		public function response($data){
			if(!empty($data) && !is_resource($data)){
				$this->responseData = $data;
			}
			else{
				$this->responseData = [
					"status" => "error",
					"message" => "Ajax response cannot be empty or resource type"
				];
			}
		}

		public function notEmptyResponse(){
			if(!empty($this->responseData)){
				return true;
			}
			return false;
		}

		public function getResponse(){
			return json_encode($this->responseData);
		}
	}
?>