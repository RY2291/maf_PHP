<?php 
require_once 'config.php';


// Library
require_once SOURCE_BASE . 'libs/helper.php';
require_once SOURCE_BASE . 'libs/auth.php';
require_once SOURCE_BASE . 'libs/router.php';

// Model
require_once SOURCE_BASE . 'models/abstract.model.php';
require_once SOURCE_BASE . 'models/user.model.php';

// Message
require_once SOURCE_BASE . 'libs/message.php';

// DB
require_once SOURCE_BASE . 'db/datasource.php';
require_once SOURCE_BASE . 'db/user.query.php';

use db\UserQuery;
use lib\Auth;

use function lib\route;

session_start();
Auth::checkSessionTime();
try {
  require_once SOURCE_BASE . 'partials/header.php';

  // $result = UserQuery::fetchById('test');

  $rpath = str_replace(BASE_URL, '', CURRENT_URI);
  $method = strtolower($_SERVER['REQUEST_METHOD']);
  
  route($rpath, $method);
  require_once SOURCE_BASE . 'partials/footer.php';

} catch (Throwable $e) {
  die('<h1>Problem</h1>');
}  
?>