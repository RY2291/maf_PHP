<?php 
require_once 'config.php';


// Library
require_once SOURCE_BASE . 'libs/helper.php';
require_once SOURCE_BASE . 'libs/auth.php';

// Model
require_once SOURCE_BASE . 'models/abstract.model.php';
require_once SOURCE_BASE . 'models/user.model.php';

// Message
require_once SOURCE_BASE . 'libs/message.php';

// DB
require_once SOURCE_BASE . 'db/datasource.php';
require_once SOURCE_BASE . 'db/user.query.php';

session_start();
require_once SOURCE_BASE . 'partials/header.php';

use db\UserQuery;
$result = UserQuery::fetchById('test');

// var_dump($result);

$rpath = str_replace(BASE_URL, '', CURRENT_URI);
$method = strtolower($_SERVER['REQUEST_METHOD']);

route($rpath, $method);

function route($rpath, $method){
  if($rpath === ''){
    $rpath = 'home';
  }
  
  $targetFile = SOURCE_BASE . "controllers/{$rpath}.php";
  if(!file_exists($targetFile)){
    require_once SOURCE_BASE . 'views/404.php';
    return;
  }
  
  require_once $targetFile;

  $fn = "\\controller\\{$rpath}\\{$method}";

  $fn();
}

// if($_SERVER['REQUEST_URI'] === '/poll/login'){
//   require_once SOURCE_BASE . 'controllers/login.php';
// }elseif ($_SERVER['REQUEST_URI'] === '/poll/register') {
//   require_once SOURCE_BASE . 'controllers/register.php';
// }elseif ($_SERVER['REQUEST_URI'] === '/poll/') {
//   require_once SOURCE_BASE . 'controllers/home.php';
// }

require_once SOURCE_BASE . 'partials/footer.php';
?>