<?php  
	interface ModelInterface{
		public static function newEntity();

		public static function patchEntity($entity, $arrayAttributes);

		public static function formatAttributeName($attributes);
	}
?>