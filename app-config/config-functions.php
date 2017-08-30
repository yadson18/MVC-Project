<?php  
  include "config.php";

  function getDatabaseConfig($dbType, $dbName){
    global $appConfiguration;

    if(array_key_exists($dbType, $appConfiguration["Databases"])){
      foreach($appConfiguration["Databases"][$dbType] as $dbIndex => $data){
        if(array_key_exists($dbName, $appConfiguration["Databases"][$dbType])){
          $databaseConfig = $appConfiguration["Databases"][$dbType][$dbName];

          return [
            "dsn" => "{$dbType}:dbname={$databaseConfig['dbPath']}; charset={$databaseConfig['charset']}",
            "user" => $databaseConfig["dbUser"],
            "password" => $databaseConfig["dbPassword"]
          ]; 
        }
      }
      return false;
    }
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