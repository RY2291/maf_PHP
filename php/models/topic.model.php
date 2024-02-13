<?php

namespace model;

use model\abstractModel\AbstractModel;
use lib\Msg;

class TopicModel extends AbstractModel
{
  public string $id;
  public string $title;
  public int $published;
  public int $views;
  public int $likes;
  public int $dislikes;
  public string $user_id;
  public int $del_flg;
  public string $nickname;

  protected static $SESSION_NAME = '_topic';

  public function isValidateId()
  {
    return true;
  }

  public static function validateId($val)
  {
    $res = true;

    if(empty($val) || !is_numeric($val)){
      Msg::push(Msg::ERROR, 'パラメータが不正です');
      $res = false;
    }
    return $res;
  }

  public function isValidateTitle()
  {
    return static::ValidateTitle($this->title);
  }
  
  public static function ValidateTitle($val)
  {
    $res = true;

    if(empty($val)){
      Msg::push(Msg::ERROR, 'タイトルが不正です。');
      $res = false;
    }elseif(mb_strlen($val) > 30){
      Msg::push(Msg::ERROR, 'タイトルの文字数は30文字いないで入力してください。');
      $res = false;
    }
    
    return $res;
  }

  public function isValidatePublished()
  {
    return static::ValidatePublished($this->published);
  }
  
  public static function ValidatePublished($val)
  {
    $res = true;

    if(!isset($val)){
      Msg::push(Msg::ERROR, '値が不正です。');
      $res = false;
    }elseif(!($val === 0 || $val === 1)){
      Msg::push(Msg::ERROR, 'ステータスが不正です。');
      $res = false;
    }

    return $res;
  }
}
