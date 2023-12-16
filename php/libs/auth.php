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

}