<?php 

namespace db;

use db\DataSource;
use models\UserModel;

class UserQuery{
  public static function fetchById($id){
    $db = new DataSource;
    $sql = 'select * from pollapp.users where id = :id';
    $result = $db->selectOne($sql, [
      ':id' => $id
    ], DataSource::CLS, UserModel::class);

    return $result;
  }
}
