<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
require('./DB/dbconnect.php');
session_start();
# ログイン確認
if (isset($_SESSION['id']) && $_SESSION ['time'] + 3600 > time()) { #idがセッションに記録されている && 最後の行動から1時間以内
  //ログインしている
  $_SESSION['time'] = time();

  $members = $pdo->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();
} else {
  //ログインしていない
  // header('Location: login.php'); exit();
}
#商品データの呼び出し
$sql = 'SELECT * FROM items WHERE id=?';
$items = $pdo->prepare($sql);
$items->execute(array($_REQUEST['id']));
$item = $items->fetch();
 ?>
 <!DOCTYPE html>
 <html lang="jp" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
<p><?php echo h($item['item']); ?></p>
<p>価格：<?php echo h($item['price']); ?>円</p>
<?php
$buy = $_POST['buy'] ?? "";
if (!empty($_POST)) {
  if ($_POST['buy'] == '') {
    $error = 'blank';
  }
  if ($_POST['buy'] <= 0) {
    $error = 'num';
  }
  if ($_POST['buy'] > $item['stock']) {
    $error = 'exceed';
  }
  //エラー無し
  if (empty($error)) {
    $_SESSION['buy'] = $_POST;
    header("Location: comform.php?id={$_REQUEST['id']}");
  }
}

 ?>
<form class="" action="" method="post">
  <input type="number" name="buy" value="" placeholder="">
  <?php if (isset($error) && $error == 'blank'): ?>
    <p>購入数を正しく入力してください。</p>
  <?php elseif(isset($error) && $error == 'num'): ?>
    <p>購入数を正しく入力してください。</p>
  <?php elseif(isset($error) && $error == 'exceed'): ?>
    <p><?php echo "申し訳ございませんが、数量オーバーです。最大購入数は{$stock}個です。"; ?></p>
  <?php endif; ?>
  <p>
    <input type="submit" name="" value="購入内容確認">
  </p>
</form>
<?php print_r($_POST['buy']); ?>
   </body>
 </html>
