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
if (isset($_SESSION['vender']['id']) && $_SESSION['vender']['time'] + 3600 > time()) {
  //ログインしている
  $_SESSION['vender']['time'] = time();
  $sql = 'SELECT * FROM venders WHERE id=?';
  $venders = $pdo->prepare($sql);
  $venders->execute(array($_SESSION['vender']['id']));
  $vender = $venders->fetch();
}
#この画面でデータを入力
$address = $_POST['address'] ?? "";
if (isset($_POST['address'])) {
  $update = 'UPDATE venders SET address=? WHERE id=?';
  $stmt = $pdo->prepare($update);
  $stmt->execute(array(
    $address,
    $_SESSION['vender']['id']
  ));
  header('Location: update_do.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- JSファイル(住所入力用) -->
<script src="https://ajaxzip3.github.io/ajaxzip3.js"></script>
  </head>
  <body>
    <?php if (empty($_POST)) $_POST['value'] = ""; ?>
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
          if (empty($_REQUEST)) $_REQUEST['id'] = "";
          $id = $_REQUEST['id'];
          $venders = $pdo->prepare('SELECT * FROM members WHERE id=?');
          $venders->execute(array($id));
          $vender = $venders->fetch();
          ?>
          <p>現在のデータ：
            <?php
            #$_POSTデータからDBの必要な情報を取り出し
            echo $vender[$_POST['value']];
            ?>
          </p>
          <?php /*
          <form class="" action="update_do.php" method="post">
          <p>新しいデータ：
            <input type="text" name="<?php print($_POST['value']); ?>" value="<?php print($member[$_POST['value']]); ?>">
          </p>
          <input type="submit" name="" value="編集する">
        </form>
*/ ?>
        <!-- ▼郵便番号入力フィールド(7桁) -->
<!-- <input type="text" name="zip11" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');"> -->
<!-- ▼住所入力フィールド(都道府県+以降の住所) -->
<!-- <input type="text" name="addr11" size="60"> -->
<pre>
<form action="" method="post">
  <!-- ▼郵便番号入力フィールド(7桁) -->
  <label>郵便番号(ハイフンもOK)</label>
  <input type="text" name="zip11" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','address','address');">
  <!-- ▼住所入力フィールド(都道府県+以降の住所) -->
  <label>都道府県と以降の住所</label>
  <input type="text" name="address" size="60" value="<?php echo h($vender['address']); ?>">
  <input type="submit" name="" value="登録する">
</form>
</pre>
          <!-- スタイル設定 -->
        </div>
          <p>
            <a href="signup.php">新規登録</a>
          </p>

      </div>
    </div>
    <!-- スタイル設定終わり -->
      <p style="width: 350px; margin: 20px auto;"><a href="./account.php">戻る</a></p>
  </body>
  </html>
