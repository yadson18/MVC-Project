<?php
  function replace($value){
    return str_replace([".", "/", "-"], "", $value);
  } 

  function toInteger($value){
    return (int) $value;
  }

  function formatMoney($money){
    $str = str_replace(['.', 'R$', ' '], "", $money);
    
    return (float) number_format(str_replace(',', '.', $str), 1, '.', '');
  }

  function formatDate($stringDate){
    return date('d.m.Y', strtotime($stringDate));
  }

  function debug($data){
    echo "<pre id='debug'>";
    var_dump($data);
    echo "</pre>";
  }
?>