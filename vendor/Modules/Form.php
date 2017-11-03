<?php  
	class Form{
		private $avaliableAttributes = [
            "input" => [
            	"class", "id", "name", "placeholder", 
            	"type" => [
            		"number", "date", "datetime", "time", "text", "radio", 
            		"checkbox", "submit", "button", "color", "password", "textarea"
            	]
            ],
            "button" => [
            	"class", "id", "type" => ["submit", "button"]
            ]
        ];

        protected function getAvaliableAtts(string $tagName){
        	if(isset($this->avaliableAttributes[$tagName])){
        		return $this->avaliableAttributes[$tagName];
        	}
        }

        protected function getTagAttributes(string $tagName, string $labelName, array $attributes){
        	if(!empty($tagName) && !empty($attributes)){
	        	$avaliableAttrs = $this->getAvaliableAtts($tagName);
	        	$tagAttributes = [];

	            foreach($attributes as $attribute => $value){
	            	if(in_array($attribute, $avaliableAttrs)){
	            		if(isset($avaliableAttrs[$attribute])){
	            			if(in_array($value, $avaliableAttrs[$attribute])){
	            				$tagAttributes[$attribute] = $value;
	            			}
	            		}
	            		else{
	            			$tagAttributes[$attribute] = $value;
	            		}
	            	}
	            }

	            if(
	            	$tagName === "input" ||
	            	$tagName === "select" ||
	            	$tagName === "button"
	            ){
		            if(!array_key_exists("class", $tagAttributes)){
		            	$tagAttributes["class"] = "form-control";
		            }
		            if($tagName === "input" || $tagName === "select"){
			            if(!array_key_exists("name", $tagAttributes)){
			            	$tagAttributes["name"] = strtolower(removeSpecialChars($labelName));
			            }
			            if(!array_key_exists("id", $tagAttributes)){
			            	$tagAttributes["id"] = strtolower(removeSpecialChars($labelName));
			            }
		            }
	            }

	            $stringAttributes = "";
	            foreach($tagAttributes as $attribute => $value){
	            	$stringAttributes .= " {$attribute}='{$value}'";
	            }

	            return $stringAttributes;
        	}
        	return false;
        }

		public function start(array $config){
            $form = "<form";

            foreach ($config as $attribute => $value){
                $form.= " {$attribute}='{$value}'";
            }

            return "{$form}>";
        }

        public function end(){
            return "</form>";
        }

        public function input(string $name, array $attributes){
            if(!empty($name)){
            	$inputAttributes = $this->getTagAttributes("input", $name, $attributes);
            	if(!empty($inputAttributes)){
                	return "
		        		<div class='form-group'>
		        			<label>{$name}</label>
		        			<input {$inputAttributes}/>
		        		</div>
        			";
            	}
            }
        }

        public function buttonSubmit(string $text){
        	return "
        		<div class='form-group'>
        			<button type='submit' class='btn'>{$text}</button>
        		</div>
        	";
        }
	}