<?php  
	class Ajax{
		public function response($data){
			if(!empty($data) && !is_resource($data)){
				echo json_encode(["response" => $data]);
			}
		}
	}
?>