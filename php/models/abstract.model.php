<?php 

namespace model\abstractModel;

abstract class AbstractModel{

	protected static $SESSION_NAME = null;

	public static function setSession($val){

		if(empty(static::$SESSION_NAME)){
			throw new \Exception('$SESSION_NAMEを設定してください');
		}
		// static::$SESSION_NAMEは継承先で参照
		return $_SESSION[static::$SESSION_NAME] = $val;
	}

	public static function getSession(){

		return $_SESSION[static::$SESSION_NAME] ?? null;
	}

	public static function clearSession(){

	  return static::setSession(null);
	}

	public static function getSessionAndFlush()
	{
		try {
			return static::getSession();
		} finally {
			static::clearSession();
		}
	}
}