<?php  
namespace controller\login;

use lib\Auth;
use lib\Msg;

function get(){
  \view\login\index();
}

function post(){
  
  $id = getParam('id', '');
  $pwd = getParam('pwd', '');

  if(Auth::login($id, $pwd)){
    Msg::push(Msg::INFO, '認証成功');
    redirect(GO_HOME);
  } else {
    Msg::push(Msg::ERROR, '認証失敗');
    redirect(GO_REFERER);
  }
}