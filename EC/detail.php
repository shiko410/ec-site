<?php
ini_set('display_errors', -1);
error_reporting(E_ALL);
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
require('./DB/dbconnect.php');
session_start();
# ログイン確認
if (isset($_SESSION['user']['id']) && $_SESSION ['user']['time'] + 3600 > time()) { #idがセッションに記録されている && 最後の行動から1時間以内
  //ログインしている
  $_SESSION['user']['time'] = time();

  $members = $pdo->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['user']['id']));
  $member = $members->fetch();
  print_r($_SESSION);

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
<div class="" style="border: 1px solid #333;">
  <p>商品情報</p>
  <p><?php echo h($item['info']); ?></p>
</div>

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
    if (!empty($_POST['now'])) {
    $_SESSION['buy'] = $_POST;
    $_SESSION['item_id'] = $_REQUEST['id'];
    header("Location: comform.php");
    exit();
  } elseif (!empty($_POST['cart'])) {
    $_SESSION['buy'] = $_POST;
    $_SESSION['item_id'] = $_REQUEST['id'];
    header("Location: ./cart/cart.php");
    exit();  }
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
    <input type="submit" name="now" value="今すぐ買う">
    <input type="submit" name="cart" value="カートに入れる">
  </p>

   </body>
 </html>
