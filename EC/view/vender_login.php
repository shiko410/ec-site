<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
		<meta name="viewprt" content="width=device-width, initial-scale=1, user-scalable=no ">
		<title>出店者ログイン</title>
		<!-- stylesheet -->
		<link rel="stylesheet" href="./CSS/form.css">

  </head>
  <body>
		<!-- スタイルの設定 -->
		<div class="top">
			<h1><a href="../index.php">ECサイト</a></h1>
			<!-- ↑セッションを削除するページへ編集予定 -->
		</div>
		<div id="wrap">
			<div class="box-inner">
				<div id="head">
					<h1>出店者ログイン</h1>
				</div>
				<div id="content">
					<!-- スタイル設定 終わり -->

					<form action="" method="post">
						<dl>
							<dt>メールアドレス</dt>
							<dd>
								<input type="text" name="email" size="45" maxlength="255" value="<?php echo h($VenderLoginModel->email); ?>" required/>
							</dd>
							<dt>パスワード</dt>
							<dd>
								<input type="text" name="password" size="45" value="<?php echo h($VenderLoginModel->password); ?>" required/>
							</dd>
							<dt>ログイン情報の記録</dt>
							<dd>
								<input id="save" type="checkbox" name="save" value="on"><label for="save">次回から自動的にログインする</label>
							</dd>
						</dl>
						<div class="input_wrap">
							<input type="submit" value="ログインする">
						</div>
					</form>
					<!-- スタイル設定 -->
				</div>
					<p>
						<a href="signup.php">新規登録</a>
					</p>
			</div>
		</div>
		<!-- スタイル設定終わり -->
  </body>
</html>