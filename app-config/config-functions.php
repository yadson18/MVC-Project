<?php  
  include "config.php";

  function getDatabaseConfig($dbType, $dbName){
    global $appConfiguration;

    if(array_key_exists($dbType, $appConfiguration["Databases"])){
      foreach($appConfiguration["Databases"][$dbType] as $dbIndex => $config){
        if($dbIndex === $dbName){
          return [
            "dsn" => "{$dbType}:dbname={$config['dbPath']}; charset={$config['charset']}",
            "user" => $config["dbUser"],
            "password" => $config["dbPassword"]
          ];
        }
      }
      return false;
    }
  }

  function setDatabaseConfig($dbType, $dbName, $arrayConfig){
    global $appConfiguration;

    if(is_array($arrayConfig)){ 
      if(array_key_exists($dbType, $appConfiguration["Databases"])){
        if(array_key_exists($dbName, $appConfiguration["Databases"][$dbType])){
          if(array_key_exists("dbPath", $arrayConfig)){
            $appConfiguration["Databases"][$dbType][$dbName]["dbPath"] = $arrayConfig["dbPath"];
          }
          if(array_key_exists("dbUser", $arrayConfig)){
            $appConfiguration["Databases"][$dbType][$dbName]["dbUser"] = $arrayConfig["dbUser"];
          }
          if(array_key_exists("dbPassword", $arrayConfig)){
            $appConfiguration["Databases"][$dbType][$dbName]["dbPassword"] = $arrayConfig["dbPassword"];
          }
          if(array_key_exists("charset", $arrayConfig)){
            $appConfiguration["Databases"][$dbType][$dbName]["charset"] = $arrayConfig["charset"];
          }
        }
      }
    }
    return false;
  }

  function getClassesPath(){
    global $appConfiguration;

    if(array_key_exists("ClassesPath", $appConfiguration)){
      return $appConfiguration["ClassesPath"];
    }
    return false;
  }

  function getAppName(){
    global $appConfiguration;

    if(array_key_exists("AppName", $appConfiguration)){
      return $appConfiguration["AppName"];
    }
    return false;
  }

  function getWebServiceConfig(){
    global $appConfiguration;

    if(array_key_exists("Webservice", $appConfiguration)){
      return $appConfiguration["Webservice"];
    }
    return false;
  }
?>