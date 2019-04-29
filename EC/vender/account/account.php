<?php
//エラー強制出力
ini_set('display_errors', 1);
error_reporting(E_ALL);
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
#SQL接続
require('../../DB/dbconnect.php');
session_start();
//$_SESSIONのidの有無、$_SESSIONの時間
if (isset ($_SESSION['vender']['id']) && $_SESSION['vender']['time'] + 3600 > time()) {
  //ログインしている
  $_SESSION['vender']['time'] = time();

  $venders = $pdo->prepare('SELECT * FROM venders WHERE id=?');
  $venders->execute(array($_SESSION['vender']['id']));
  $vender = $venders->fetch();
} else {
  //ログインしていない時の処理
  header('Location: ./login.php');
}
 ?>
<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- stylesheer -->
    <link rel="stylesheet" href="../../CSS/form.css">
  </head>
  <body>
<!-- スタイルの設定 -->
      <div class="top">
        <h1><a href="../../index.php">ECサイト</a></h1>
        <!-- ↑ セッションを削除するページへ編集予定 -->
      </div>
      <div id="wrap">
        <div class="box-inner">
          <div id="head">
            <h1><?php echo h($vender['name']); ?>さんようこそ</h1>
          </div>
        <div id="content">
<!-- スタイルの設定 終わり -->

        <a href="./index-venders.php">
          <div class="box">
            <p>商品登録</p>
          </div>
        </a>

        <a href="./order_history.php">
          <div class="box">
            <p>注文履歴</p>
          </div>
        </a>
        <a href="./view.php">
          <div class="box">
            <p>商品一覧</p>
          </div>
        </a>
        <a href="./account-info.php">
          <div class="box">
            <p>アカウント情報の変更</p>
          </div>
        </a>
        <a href="./payment.php">
          <div class="box">
            <p>口座の変更</p>
          </div>
        </a>
<!--スタイル設定 -->
    </div>
    </div>
  </div>
<!-- スタイル設定終わり -->
  </body>
</html>
