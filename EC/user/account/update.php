<?php
//エラー強制出力
ini_set('display_errors', 1);
error_reporting(E_ALL);
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
#SQL接続
require('../../DB/dbconnect.php');
session_start();
#ログイン状態の確認
if (isset($_SESSION['user']['id']) && $_SESSION['user']['time'] + 3600 > time()) {
  // ログインしている
  $_SESSION['user']['time'] = time();

  $members = $pdo->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['user']['id']));
  $member = $members->fetch();
}
?>
<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- stylesheet -->

  </head>
  <body>
    <p><?php print($_POST['value']); ?></p>
    <p><?php print_r($_POST); ?></p>
    <!-- スタイルの設定 -->
		<div class="top">
			<h1><a href="../index.php">ECサイト</a></h1>
			<!-- ↑セッションを削除するページへ編集予定 -->
		</div>
		<div id="wrap">
			<div class="box-inner">
				<div id="head">
					<h1>編集画面</h1>
				</div>
				<div id="content">
					<!-- スタイル設定 終わり -->
          <!-- DB出力 -->
          <?php
          $id = $_REQUEST['id'];
          $members = $pdo->prepare('SELECT * FROM members WHERE id=?');
          $members->execute(array($id));
          $member = $members->fetch();
          ?>
          <p>現在のデータ：
            <?php
            #$_POSTデータからDBの必要な情報を取り出し
            echo $member[$_POST['value']];
            ?>
          </p>
          <form class="" action="update_do.php" method="post">

          <p>新しいデータ：
            <input type="text" name="<?php print($_POST['value']); ?>" value="<?php print($member[$_POST['value']]); ?>">
          </p>
          <input type="submit" name="" value="編集する">
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
