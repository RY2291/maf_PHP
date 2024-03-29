<?php

namespace view\login;

function index()
{
?>
	<h1 class="sr-only">ログイン</h1>
	<div class="mt-5">
		<div class="text-center mb-4">
			<img width="65" src="images/logo.svg" alt="みんなのアンケート　サイトロゴ">
		</div>
		<div class="login-form bg-white p-4 shadow-sm mx-auto rounded">
			<form class="validate-form" action="<?php echo CURRENT_URI; ?>" method="post">
				<div class="form-group">
					<label for="id">ユーザーID</label>
					<input type="text" name="id" id="id" class="form-control validate-target" required autofocus minlength="4" maxlength="10" pattern="[a-zA-Z0-9]+">
					<div class="invalid-feedback"></div>
				</div>
				<div class="form-group">
					<label for="pwd">パスワード</label>
					<input type="password" name="pwd" id="pwd" class="form-control validate-target" required minlength="4">
					<div class="invalid-feedback"></div>
				</div>
				<div class="d-flex align-items-center justify-content-between">
					<div>
						<a href="<?php theUrl('register'); ?>">アカウント登録</a>
					</div>
					<div>
						<input type="submit" value="ログイン" class="btn btn-primary shadow-sm">
					</div>
				</div>
			</form>
		</div>
	</div>
<?php } ?>