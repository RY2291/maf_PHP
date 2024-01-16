<?php 

namespace db;

use db\DataSource;
use model\CommentModel;

class CommentQuery{
  public static function fetchByTopicId($topic)
  {
    if(!$topic->isValidateId()){
      return false;
    }

    $db = new DataSource;
    $sql = 'SELECT 
              c.*
            , u.nickname
            FROM comments c
            INNER JOIN users u ON
              c.user_id = u.id
            WHERE
                c.topic_id = :id
            AND c.body != ""
            AND c.del_flg = 0
            AND u.del_flg = 0
            ORDER BY
              c.id desc
            ';
    $result = $db->select($sql, [
      ':id' => $topic->id
    ], DataSource::CLS, CommentModel::class);

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
