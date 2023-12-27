<?php 
namespace model;

use model\abstractModel\AbstractModel;
use lib\Msg;

class UserModel extends AbstractModel{
  public string $id;
  public string $pwd;
  public string $nickname;
  public int $del_flg;

  protected static $SESSION_NAME = '_user';

  public function isValidateId()
  {
    return static::validateId($this->id);
  }

  public static function validateId($val)
  {
    $res = true;

    if(empty($val)){
      Msg::push(Msg::ERROR, 'ユーザのIDを入力してくダサい');
      $res = false; 
    } else{
      
      if(strlen($val) > 10){
        Msg::push(Msg::ERROR, 'ユーザのIDを10桁以下で入力してくダサい');
        $res = false; 
      }
      
      if(!preg_match("/^[a-zA-Z0-9]+$/",$val)){
        Msg::push(Msg::ERROR, '半角英数字で入力してください');
        $res = false; 
      }
    }

    return $res;
  }
}
