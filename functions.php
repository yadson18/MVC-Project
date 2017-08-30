<?php
  include "app-config/config-functions.php";

  function phpToJs($values){
    if(is_array($values)){
      $json = json_encode($values);

      return "<script type='text/javascript'>var phpVariables = {$json}; </script>";
    }
  }

  function replace($string){
    return str_replace([".", "/", "-"], "", $string);
  } 

  function toInteger($value){
    return (int) $value;
  }

  function debug($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
  }
?>