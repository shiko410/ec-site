<?php
//エラー強制出力
//エラーを画面に表示(1を0にすると画面上にはエラーが出ない)
ini_set('display_errors', 1);
//すべてのエラーを表示
error_reporting(E_ALL);
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
#SQL接続
require('../DB/dbconnect.php');
session_start();
?>
<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
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
          #$_POST['id']はinput_hiddenで送信
          $stmt = $pdo->prepare('UPDATE items SET info=? WHERE id=?');
          $stmt->execute(array($_POST['info'], $_POST['id']));
           ?>
           <p>内容を変更しました</p>
           <p>
             <a href="view.php">戻る</a>
           </p>

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
