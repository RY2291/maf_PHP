<?php
namespace lib;

use db\UserQuery;

class Auth{
  public static function login($id, $pwd){
    $is_success = false;
  
    $user = UserQuery::fetchById($id);
    
    if(!empty($user) && $user->del_flg === 0){
      $result = password_verify($pwd, $user->pwd);
      if($result){
        $is_success = true;
        $_SESSION['user'] = $user;
      } else {
        echo 'not match password' . "<br>";
      }
    } else {
      echo 'not find user' . "<br>";
    }

    return $is_success;
  }

  public static function regist($user){
    $is_success = false;
    
    $exists_user = UserQuery::fetchById($user->id);

    if(!empty($exists_user)){
      echo 'already user';
      
      return false;
    }

    $is_success = UserQuery::insert($user);


    return $is_success;
  }

}