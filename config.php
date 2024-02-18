<?php 
const BASE_URL = "/poll/";

define('CURRENT_URI', $_SERVER['REQUEST_URI']);
define('BASE_IMAGE_PATH', BASE_URL . '/images\/');
define('BASE_JS_PATH', BASE_URL . 'js/');
define('BASE_CSS_PATH', BASE_URL . '/css\/');
define('SOURCE_BASE', __DIR__ . '/php/');

define('GO_HOME', 'home');
define('GO_REFERER', 'referer');

define('DEBUG', true);

