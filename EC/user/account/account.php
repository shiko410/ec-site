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
//$_SESSIONのidの有無、$_SESSIONの時間
if (isset ($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  //ログインしている
  $_SESSION['time'] = time();

  $members = $pdo->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();
} else {
  //ログインしていない時の処理
  header('Location: ./login.php');
}
 ?>
<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>アカウント管理</title>
    <!-- stylesheet -->
    <link rel="stylesheet" href="../../CSS/form.css">
  </head>
  <body>
<!-- スタイルの設定 -->
      <div class="top">
        <h1><a href="../index.php">ECサイト</a></h1>
        <!-- ↑ セッションを削除するページへ編集予定 -->
      </div>
      <div id="wrap">
        <div class="box-inner">
          <div id="head">
            <h1>アカウント情報</h1>
          </div>
        <div id="content">
<!-- スタイルの設定 終わり -->
        <a href="./order-history.php">
          <div class="box">
            <p>注文履歴</p>
          </div>
        </a>
        <a href="./account-info.php">
          <div class="box">
            <p>アカウント情報の変更</p>
          </div>
        </a>
        <a href="./address.php">
          <div class="box">
            <p>送付先の変更</p>
          </div>
        </a>
        <a href="./payment.php">
          <div class="box">
            <p>支払い方法の変更</p>
          </div>
        </a>
<!--スタイル設定 -->
    </div>
    </div>
  </div>
<!-- スタイル設定終わり -->
  </body>
</html>
