<?php

namespace lib;

use model\abstractModel\AbstractModel;
use Throwable;

class Msg extends AbstractModel
{
  protected static $SESSION_NAME = '_msg';

  public const ERROR = 'error';
  public const INFO  = 'info';
  public const DEBUG = 'debug';


  public static function push($type, $msg)
  {
    if (!is_array(static::getSession())) {
      static::init();
    }

    $msgs = static::getSession();

    $msgs[$type][] = $msg;
    static::setSession($msgs);
  }

  public static function flush()
  {
    try {
      $msgs_with_type = static::getSessionAndFlush() ?? [];

      foreach ($msgs_with_type as $type => $msgs) {
        if($type === static::DEBUG && !DEBUG){
          continue;
        }

        $color = $type === static::INFO ? 'alert-primary' : 'alert-danger';

        foreach ($msgs as $msg) {
          echo "<div class='alert $color'>{$msg}</div>";
        }
      }
    } catch (Throwable $e) {

      Msg::push(Msg::ERROR, 'Msg::flushで例外発生しました');
      Msg::push(Msg::DEBUG, $e->getMessage());
    }

  }

  private static function init()
  {
    static::setSession([
      static::ERROR => [],
      static::INFO  => [],
      static::DEBUG => []
    ]);
  }
}
