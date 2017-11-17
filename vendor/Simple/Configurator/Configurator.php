<?php 
	namespace Simple\Configurator;

	class Configurator{
		private static $Instance;
		private $appConfigs = [];

		private function __construct(){}

		public static function getInstance(){
			if(!isset(self::$Instance)){
				self::$Instance = new Configurator();
			}
			return self::$Instance;
		}

		public function set(string $configName, $configValue){
			if(!empty($configName) && !is_numeric($configName)){
				if(is_bool($configValue) || !empty($configValue)){
					$this->appConfigs[$configName] = $configValue;
				
					return $this;
				}
			}
			return false;
		}

		public function get(string $configName, string $subConfigName = null){
			if(!empty($configName)){
				if(isset($this->appConfigs[$configName])){
					if(!empty($subConfigName)){
						if($this->findConfigKey($this->appConfigs[$configName], $subConfigName)){
							return $this->findConfigKey($this->appConfigs[$configName], $subConfigName);
						}
					}
					return $this->appConfigs[$configName];
				}
			}

			if(array_key_exists($configName, $this->appConfigs)){
				return $this->appConfigs[$configName];
			}
			return false;
		}

		protected function findConfigKey(array $arrayConfig, string $keyToFind){
			if(!empty($arrayConfig) && !empty($keyToFind)){
				foreach($arrayConfig as $key => $value){
					if($keyToFind === $key){
						return $value;
					}
					else if(is_array($value) && !empty($value)){
						if(!empty($this->findConfigKey($value, $keyToFind))){
							return $this->findConfigKey($value, $keyToFind);
						}
					}
				}
			}
		}
	}