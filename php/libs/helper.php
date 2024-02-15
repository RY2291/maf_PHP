<?php

function getParam($key, $default_val, $is_post = true)
{
	$arry = $is_post ? $_POST : $_GET;
	// var_export($arry);
	return $arry[$key] ?? $default_val;
}

function redirect($path)
{
	echo $path;
	if ($path === GO_HOME) {
		$path = 'home';
	} else if ($path === GO_REFERER) {
		$path = $_SERVER['HTTP_REFERER'];
	} else {
		$path = getUrl($path);
	}
	header("Location: {$path}");
	die();
}

function getUrl($path)
{
	return BASE_URL . trim($path, '/');
}

function theUrl($path)
{
	echo getUrl($path);
}

function is_alnum($val)
{
	return preg_match("/^[a-zA-Z0-9]+$/", $val);
}

function escape($data)
{
	if (is_array($data)) {

		foreach ($data as $prop => $val) {
			$data[$prop] = escape($val);
		}

		return $data;
	} elseif (is_object($data)) {

		foreach ($data as $prop => $val) {
			$data->$prop = escape($val);
		}

		return $data;
	} else {

		htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
	}
}
