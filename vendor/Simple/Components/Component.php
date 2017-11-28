<?php 
	namespace Simple\Components;

	class Component
	{
		private $ComponentToLoad;

		public function __construct(string $componentName)
		{
			$Component = "Simple\\Components\\{$componentName}\\{$componentName}";
			
			if (class_exists($Component)) {
				$this->ComponentToLoad = $Component;
			}
		}

		public function load()
		{
			if (isset($this->ComponentToLoad)) {
				return new $this->ComponentToLoad;
			}
			return false;
		}
	}