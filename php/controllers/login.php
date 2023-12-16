<?php  
namespace controller\login;

use lib\Auth;


function get(){
  require_once SOURCE_BASE . 'views/login.php';
}

function post(){
  $id = getParam('id', '');
  $pwd = getParam('pwd', '');

  if(Auth::login($id, $pwd)){
    echo '認証成功' . "<br>";
  } else {
    echo '認証失敗'. "<br>";
  }
}