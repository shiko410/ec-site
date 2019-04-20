<?php require('../DB/dbconnect.php'); ?>

<?php
session_start();

if (!empty($_POST)) { #送信ボタンがクリックされたら以下を実行
	//ログイン処理
	if ($_POST['email'] != '' && $_POST['password'] != '') {
		#$loginにBDからemailとpasswordを取り出す
		$login = $pdo->prepare('SELECT * FROM venders WHERE email=? AND password=?');
		$login->execute(array(
		#検索するDBのカラムはPOSTで送信する値
		$_POST['email'],
		#DBにはpasswordが暗号化されているため、暗号化した値を送信して検索
		sha1($_POST['password'])
		));
		#DBからfetchメソッドで値を取り出す
		$vender = $login->fetch();

		#DBから取り出した値($venderに格納)があればログイン成功
		if ($vender) {
			//ログイン成功
			//セッションにidとtimeを記録する
			$_SESSION['id'] = $vender['id'];
			$_SESSION['time'] = time();

			header('Location: ./index-venders.php');

		} else {
			#ログイン失敗時の処理
			$error['login'] = 'failed';
		}
	} else {
		#空白時の処理
		$error['login'] = 'blank';
	}

}

?>

<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
		<meta name="viewprt" content="width=device-width, initial-scale=1, user-scalable=no ">
		<title>出店者ログイン</title>
		<!-- stylesheet -->
		<link rel="stylesheet" href="../CSS/form.css">

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
								<input type="text" name="email" size="45" maxlength="255" value="<?php echo h($_POST['email']); ?>" >
							</dd>
							<dt>パスワード</dt>
							<dd>
								<input type="text" name="password" size="45" value="<?php echo h($_POST['password']); ?>">
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