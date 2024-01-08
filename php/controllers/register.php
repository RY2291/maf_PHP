<?php  
namespace controller\register;

use lib\Auth;
use model\UserModel;

function get(){
  \view\register\index();
}

function post(){

  $user = new UserModel;
  $user->id       = getParam('id', '');
  $user->pwd      = getParam('id', '');
  $user->nickname = getParam('nickname', '');

  if(Auth::regist($user)){
    redirect(GO_HOME);
    echo '登録成功';
  }else{
    redirect(GO_REFERER);
    echo '登録失敗';
  }
};