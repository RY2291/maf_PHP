<?php 

function getParam($key, $default_val, $is_post = true){
  $arry = $is_post ? $_POST : $_GET;
  // var_export($arry);
  return $arry[$key] ?? $default_val;
}