<?php
  include CONFIG . "config-functions.php";

  function cnpjFormat($cnpj){
    if(strlen($cnpj) === 14){
      $cnpjFormated = substr($cnpj, 0, 2) .".". 
                      substr($cnpj, 2, 3) .".". 
                      substr($cnpj, 5, 3) ."/". 
                      substr($cnpj, 8, 4) ."-". 
                      substr($cnpj, 12, 14);
      return $cnpjFormated;
    }
    return $cnpj;
  }

  function phpToJs($values){
    if(is_array($values)){
      $json = json_encode($values);

      return "<script type='text/javascript'>var phpVariables = {$json}; </script>";
    }
  }

  function replace($string){
    return str_replace([".", "/", "-", "_"], "", $string);
  } 

  function toInteger($value){
    return (int) $value;
  }

  function debug($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
  }