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
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  //ログインしている
  $_SESSION['time'] = time();
  $sql = 'SELECT * FROM members WHERE id=?';
  $members = $pdo->prepare($sql);
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();
}
#この画面でデータを入力

#4文字以下であればエラー
if (isset($_POST['new_password']) && strlen($_POST['new_password']) >= 4) {
  $update = 'UPDATE members SET password=? WHERE id=?';
  $stmt = $pdo->prepare($update);
  $stmt->execute(array(
    sha1($_POST['new_password']),
    $_SESSION['id']
  ));
  header('Location: update_do.php');
  exit();
} else if (isset($_POST['new_password'])){
  $error['password'] = 'length';
}
#確認用
// print_r(strlen($_POST['new_password']). "\n");
// print_r($error. "\n");
// var_dump($_POST. "\n");
?>
<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

  </head>
  <body>
    <p><?php $password = $_POST['value'] ?? "";
    print($password); ?></p>
    <p><?php print_r($_POST); ?></p>
    <!-- スタイルの設定 -->
    <div class="top">
      <h1><a href="../../../index.php">ECサイト</a></h1>
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
          // $id = $_REQUEST['id'];
          // $members = $pdo->prepare('SELECT * FROM members WHERE id=?');
          // $members->execute(array($id));
          // $member = $members->fetch();
          ?>
          <p>現在のデータ：【表示されません】
            <?php
            #$_POSTデータからDBの必要な情報を取り出し
            //echo $member[$_POST['value']];
            ?>
          </p>
<pre>
<form action="" method="post">
  <label>新しいパスワード</label>
  <input type="text" name="new_password" size="60" value="">
  <?php if (isset($error['password']) && $error['password'] == 'length'): ?>
    <p>※パスワードは4文字以上で入力してください</p>
  <?php endif; ?>
  <input type="submit" name="" value="登録する">
</form>
</pre>
          <!-- スタイル設定 -->
        </div>
          <p>
            <a href="./account-info.php">戻る</a>
          </p>
          <p>
            <a href="signup.php">新規登録</a>
          </p>

      </div>
    </div>
    <!-- スタイル設定終わり -->
  </body>
  </html>
