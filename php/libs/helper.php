<?php 

function getParam($key, $default_val, $is_post = true){
  $arry = $is_post ? $_POST : $_GET;
  // var_export($arry);
  return $arry[$key] ?? $default_val;
}

function redirect($path){
  echo $path;
  if($path === GO_HOME){
    $path = 'home';
  } else if($path === GO_REFERER){
    $path = $_SERVER['HTTP_REFERER'];
  } else {
    $path = getUrl($path);
  }
  header("Location: {$path}");
  die();
}

function getUrl($path){
  return BASE_URL . $path;
}