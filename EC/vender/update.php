<?php
//エラー出力強制
ini_set( 'display_errors', 1 ); // エラーを画面に表示(1を0にすると画面上にはエラーは出ない)
//すべてのエラー表示
error_reporting( E_ALL );
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
#sql接続
require('../DB/dbconnect.php');
session_start();
//$_SESSIONのidの有無、$_SESSIONの時間
if (isset ($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
	//ログインしている
	$_SESSION['time'] = time();

	$venders = $pdo->prepare('SELECT * FROM venders WHERE id=?');
	$venders->execute(array($_SESSION['id']));
	$vender = $venders->fetch();
} else {
	//ログインしていないときの処理
	header('Location: ./login.php');
}

?>
<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
		<title>出品内容変更画面</title>
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
<?php
#URLパラメータで情報を呼び出す
if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) { #URLにidが格納されていて∧値がINTのとき
	$id = $_REQUEST['id'];
}
#フォームにDBデータを呼び出し
	$stmt = $pdo->prepare('SELECT * FROM items WHERE id=?');
	$stmt->execute(array($id));
	$stm = $stmt->fetch();

?>
					<form action="update_do.php" method="post">
						<!-- 投稿をアップデートする -->
						<input type="hidden" name="id" value="<?php print($_REQUEST['id']); ?>">

						<!-- id -->
						<p>ID:
						<input type="text" name="" value="<?php print($stm['id']); ?>" size="45">
						</p>
						<!-- item -->
						<p>商品名：
							<input type="text" name="item" value="<?php print($stm['item']); ?>" size="45">
						</p>
						<!-- price -->
						<p>価格：
							<input type="text" name="price" value="<?php print($stm['price']); ?>" size="45">
						</p>
						<!-- stock -->
						<p>在庫：
							<input type="text" name="stock" value="<?php print($stm['stock']); ?>" size="45">
						</p>
						<!-- info -->
						<p>詳細：
						<textarea name="info" rows="8" cols="45"><?php print($stm['info']); ?></textarea><br>
						</p>
						<button type="submit" >登録する</button>
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
