<?php 
require_once 'config.php';


// Library
require_once SOURCE_BASE . 'libs/helper.php';
require_once SOURCE_BASE . 'libs/auth.php';
require_once SOURCE_BASE . 'libs/router.php';

// Model
require_once SOURCE_BASE . 'models/abstract.model.php';
require_once SOURCE_BASE . 'models/user.model.php';
require_once SOURCE_BASE . 'models/topic.model.php';
require_once SOURCE_BASE . 'models/comment.model.php';

// Message
require_once SOURCE_BASE . 'libs/message.php';

// DB
require_once SOURCE_BASE . 'db/datasource.php';
require_once SOURCE_BASE . 'db/user.query.php';
require_once SOURCE_BASE . 'db/topic.query.php';
require_once SOURCE_BASE . 'db/comment.query.php';

// partials
require_once SOURCE_BASE . 'partials/header.php';
require_once SOURCE_BASE . 'partials/footer.php';
require_once SOURCE_BASE . 'partials/topic_header_item.php';
require_once SOURCE_BASE . 'partials/topic_list_item.php';

// View
require_once SOURCE_BASE . 'views/home.php';
require_once SOURCE_BASE . 'views/login.php';
require_once SOURCE_BASE . 'views/register.php';
require_once SOURCE_BASE . 'views/topic/archive.php';
require_once SOURCE_BASE . 'views/topic/detail.php';
require_once SOURCE_BASE . 'views/topic/edit.php';

use lib\Auth;
use function lib\route;

session_start();
Auth::checkSessionTime();
try {
  \partials\header();
  $parse_url = parse_url(CURRENT_URI);
  $rpath = str_replace(BASE_URL, '', $parse_url['path']);
  $method = strtolower($_SERVER['REQUEST_METHOD']);

  route($rpath, $method);
  \partials\footer();

} catch (Throwable $e) {
  die('<h1>Problem</h1>');
}  
?>