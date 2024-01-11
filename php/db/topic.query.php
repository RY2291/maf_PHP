<?php 

namespace db;

use db\DataSource;
use model\TopicModel;

class TopicQuery{
  public static function fetchByUserId($user){

    if(!$user->isValidateId()){
        return false;
    }

    $db = new DataSource;
    $sql = 'select * from pollapp.topics where user_id = :id and del_flg = 0 order by id desc';
    $result = $db->select($sql, [
      ':id' => $user->id
    ], DataSource::CLS, TopicModel::class);

    return $result;
  }

//   public static function insert($user){
//     $db = new DataSource;
//     $sql = 'INSERT INTO users(id, pwd, nickname) VALUES(:id, :pwd, :nickname)';
    
//     $user->pwd = password_hash($user->pwd, PASSWORD_BCRYPT);

//     return $db->execute($sql, [
//       ':id' => $user->id,
//       ':pwd' => $user->pwd,
//       ':nickname' => $user->nickname,
//     ]);
//   }
}
