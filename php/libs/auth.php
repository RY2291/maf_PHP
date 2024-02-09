<?php
namespace lib;

use db\TopicQuery;
use db\UserQuery;
use model\UserModel;

class Auth{
  public static function login($id, $pwd)
  {
    try {
      if(!(UserModel::validateId($id)
          * UserModel::validatePwd($pwd))){
        return false;
      }
      $is_success = false;
    
      $user = UserQuery::fetchById($id);
      
      if(!empty($user) && $user->del_flg === 0){
        $result = password_verify($pwd, $user->pwd);
        if($result){
          $is_success = true;
          UserModel::setSession($user);
        } else {
          echo 'not match password' . "<br>";
        }
      } else {
        echo 'not find user' . "<br>";
      }
    } catch (\Throwable $e) {
      $is_success = false;
      Msg::push(Msg::ERROR, 'ログイン処理でエラーが発生しました。');
      Msg::push(Msg::DEBUG, $e->getMessage());
    }

    return $is_success;
  }

  public static function regist($user)
  {
    try {
      if(!($user->isValidateId() 
         * $user->isValidPwd()
         * $user->isValidNickname())){
        return false;
      }
      $is_success = false;

      $exists_user = UserQuery::fetchById($user->id);

      if(!empty($exists_user)){
        echo 'already user';

        return false;
      }

      $is_success = UserQuery::insert($user);

      if($is_success){
        UserModel::setSession($user);
      }
    } catch (\Throwable $e) {
      $is_success = false;
      Msg::push(Msg::ERROR, '登録処理でエラーが発生しました。');
      Msg::push(Msg::DEBUG, $e->getMessage());
    }

    return $is_success;
  }

  public static function isLogin()
  {
    try {
      $user = UserModel::getSession();

    } catch (\Throwable $e) {
      UserModel::clearSession();
      Msg::push(Msg::ERROR, 'エラーが発生しました。もう一度ログインしてください');
      Msg::push(Msg::DEBUG, $e->getMessage());

      return false;
    }

    if(isset($user)){
      return true;
    } else{
      return false;
    }
  }

    public static function logout()
    {
      try {
        UserModel::clearSession(); 
      } catch (\Throwable $e) {
        UserModel::clearSession();
        Msg::push(Msg::DEBUG, $e->getMessage());
      }

      return true;
    }

    public static function checkSessionTime()
    {
      try {
        $user = UserModel::getSession();
        if(!$user){
          return false;
        }

        $last_activity = isset($_SESSION['last_activity']) ? $_SESSION['last_activity'] : time();
        $_SESSION['last_activity'] = time();
        $logout_time = 3600;

        if(time() - $last_activity > $logout_time){
          $path = BASE_URL . 'login';
          UserModel::clearSession();
          header("Location: {$path}");
          Msg::push(Msg::INFO, 'セッションタイムアウト');
          exit();
        }
      } catch (\Throwable $e) {
        UserModel::clearSession();
        Msg::push(Msg::DEBUG, $e->getMessage());
      }

      return true;
    }

    public static function requireLogin()
    {
      if(!Auth::isLogin()){
        Msg::push(Msg::ERROR, 'ログインしてください');
        redirect('login');
      }
    }

    public static function hasPermission($topic_id, $user)
    {
      return TopicQuery::isUserOwnTopic($topic_id, $user);
    }

    public static function requirePermission($topic_id, $user)
    {
      if(!static::hasPermission($topic_id, $user)){
        Msg::push(Msg::ERROR, '編集権限がありません。ログインを再度行ってください。');
        redirect('login');
      }
    }
}