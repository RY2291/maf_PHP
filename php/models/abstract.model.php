<?php 

use model\abstract;

abstract class AbstractModel{

	protected static $SESSION_NAME = null;

	public static function setSession($val){

		if(empty(static::$SESSION_NAME)){
			throw new Error('$SESSION_NAMEを設定してください');
		}

		$_SESSION[static::$SESSION_NAME] = $val;
	}

	public static function getSession(){

		return $_SESSION[static::$SESSION_NAME] ?? null;
	}

	public static function clearSession(){

	  return static::setSession(null);
	}
}