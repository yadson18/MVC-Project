<?php  
    include CONFIG . "config.php";

    function getDatabaseConfig(string $dbType, string $dbName){
        global $appConfiguration;

        if(isset($appConfiguration["Databases"][$dbType][$dbName])){
            $config = $appConfiguration["Databases"][$dbType][$dbName];

            return [
                "dsn" => "{$dbType}:dbname={$config['dbPath']}; charset={$config['charset']}",
                "user" => $config["dbUser"],
                "password" => $config["dbPassword"]
            ];
        }
        return false;
    }

    function getDefaultErrorPage(){
        global $appConfiguration;

        if(isset($appConfiguration["DefaultErrorPage"])){
            return $appConfiguration["DefaultErrorPage"];
        }
        return false;
    }

    function getSalt(){
        global $appConfiguration;

        if(isset($appConfiguration["Salt"])){
            return $appConfiguration["Salt"];
        }
        return false;
    }

    function getDefaultRoute(){
        global $appConfiguration;

        if(isset($appConfiguration["DefaultRoute"])){
            return $appConfiguration["DefaultRoute"];
        }
        return false;
    }

    function setDatabaseConfig(string $dbType, string $dbName, array $arrayConfig){
        global $appConfiguration;

        if(!empty($arrayConfig)){
            if(isset($appConfiguration["Databases"][$dbType][$dbname])){
                foreach($arrayConfig as $configColumn => $configValue){
                    if(isset($appConfiguration["Databases"][$dbType][$dbName][$configColumn])){
                        $appConfiguration["Databases"][$dbType][$dbName][$configColumn] = $configValue;
                    }
                }
                return true;
            }
        }
        return false;
    }

    function getClassesPath(){
        global $appConfiguration;

        if(isset($appConfiguration["ClassesPath"])){
            return $appConfiguration["ClassesPath"];
        }
        return false;
    }

    function getAppName(){
        global $appConfiguration;

        if(isset($appConfiguration["AppName"])){
            return $appConfiguration["AppName"];
        }
        return false;
    }

    function getWebServiceConfig(){
        global $appConfiguration;

        if(isset($appConfiguration["Webservice"])){
            return $appConfiguration["Webservice"];
        }
        return false;
    }