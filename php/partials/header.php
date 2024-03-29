<?php
namespace partials;

use lib\Auth;
use lib\Msg;

function header(){
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>アンケート</title>
	<link rel="stylesheet" href="<?php echo BASE_CSS_PATH ?>sample.css">
	<title>みんなのアンケート</title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="//fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo BASE_CSS_PATH ?>style.css">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
	<div id="container">
		<header class="container my-2">
			<nav class="row align-items-center py-2">
				<a href="<?php theUrl('/'); ?>" class="col-md d-flex align-items-center mb-3 mb-md-0">
					<img width="50" class="mr-2" src="<?php echo BASE_IMAGE_PATH ?>logo.svg" alt="みんなのアンケート　サイトロゴ">
					<span class="h2 font-weight-bold mb-0">みんなのアンケート</span>
				</a>
				<div class="col-md-auto">
					<?php if (Auth::isLogin()) : ?>
						<!-- ログインしているとき -->
						<a href="<?php theUrl('topic/create'); ?>" class="btn btn-primary mr-2">投稿</a>
						<a href="<?php theUrl('topic/archive'); ?>">過去の投稿</a>
						<a href="<?php theUrl('logout'); ?>">ログアウト</a>
					<?php else : ?>
						<a href="<?php theUrl('register'); ?>" class="btn btn-primary mr-2">登録</a>
						<a href="<?php theUrl('login'); ?>">ログイン</a>
					<?php endif; ?>
				</div>
			</nav>
		</header>
		<main class="container py-3">
<?php
Msg::flush();
if (Auth::isLogin()) {
	echo 'ログイン中';
} else {
	echo 'ログインしていません';
}
}
?>