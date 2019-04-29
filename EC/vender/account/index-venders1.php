<?php
//エラー出力強制
ini_set( 'display_errors', 1 ); // エラーを画面に表示(1を0にすると画面上にはエラーは出ない)
//すべてのエラー表示
error_reporting( E_ALL );
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
#sql接続
require('../../DB/dbconnect.php');
session_start();
#ログイン処理
//$_SESSIONのidの有無、$_SESSIONの時間
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  //ログインしている
  $_SESSION['time'] = time();

  $venders = $pdo->prepare('SELECT * FROM venders WHERE id=? ');
  $venders->execute(array($_SESSION['id']));
  $vender = $venders->fetch();
} else {
  //ログインしていないときの処理
  header('Location: ./login.php');
}


#投稿を記録する
if(!empty($_POST)) {  #登録ボタンがクリックされたら以下を実行
  if ($_POST['info'] != '') {
		$info = $pdo->prepare('INSERT INTO items SET vender_id=?,  info=?, created=NOW()');
		$info->execute(array(
			$vender['id'],
			$_POST['info']
		));

    header('Location: index-venders1.php'); exit();
  }
}
print_r($vender);
?>
<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>投稿場面</title>
    <link rel="stylesheet" href="../CSS/form.css">
  </head>
  <body>
    <div id="wrap">
      <p><?php echo h($vender['name']); ?>さん、ようこそ</p>
      <div id="head">
        <h1>投稿画面</h1>
      </div>
      <div id="content">

      </div>
      <!-- actionが空になっているので、現在のページに送信される -->
      <form action="" method="post">
        <dl>
          <dt>詳細</dt>
          <dd>
            <textarea name="info" rows="5" cols="45"></textarea>
          </dd>
        </dl>
        <div>
          <input type="submit" value="登録する">
        </div>
      </form>
      <div class="detail">
        <p>
          <a href="view.php">登録一覧画面</a>
        </p>
      </div>
    </div>
  </body>
</html>
