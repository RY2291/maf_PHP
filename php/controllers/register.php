<?php  
namespace controller\register;

use lib\Auth;
use model\UserModel;

function get(){
  require_once SOURCE_BASE . 'views/register.php';
}

function post(){

  $user = new UserModel;
  $user->id       = getParam('id', '');
  $user->pwd      = getParam('id', '');
  $user->nickname = getParam('nickname', '');

  if(Auth::regist($user)){
    echo '登録成功';
  }else{
    echo '登録失敗';
  }
};