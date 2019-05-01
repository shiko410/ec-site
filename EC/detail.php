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
  $login = "unlogin";
}
#商品データの呼び出し
$sql = 'SELECT * FROM items WHERE id=?';
$items = $pdo->prepare($sql);
$items->execute(array($_REQUEST['id']));
$item = $items->fetch();
$stock= $item['stock'];
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

if (!empty($_POST)) {
  if ($_POST['p_num'] == '') {
    $error = 'blank';
  } elseif ($_POST['p_num'] <= 0) {
    $error = 'num';
  } elseif ($_POST['p_num'] > $item['stock']) {
    $error = 'exceed';
  } elseif (isset($login) && $login == "unlogin") {
    $error = 'login';
  }
  //エラー無し
  if (empty($error)) {
    if (!empty($_POST['now'])) {
    $_SESSION[] = $_POST;
    $_SESSION[] = $_REQUEST['id'];
    header("Location: comform.php");
    exit();
  } elseif (!empty($_POST['cart'])) {
    $_SESSION['new'][] = $_POST;
    header("Location: ./cart/cart.php");
    exit();  }
  }
}
 ?>
<form class="" action="" method="post">
  <input type="hidden" name="item_id" value="<?php echo $_REQUEST['id'] ?>">
  数量：<input type="number" name="p_num" value="" placeholder="">
  <?php if (isset($error) && $error == 'blank'): ?>
    <p>購入数が入力されていません。購入数を正しく入力してください。</p>
  <?php elseif(isset($error) && $error == 'num'): ?>
    <p>購入数を正しく入力してください。</p>
  <?php elseif(isset($error) && $error == 'exceed'): ?>
    <p><?php echo "申し訳ございませんが、数量オーバーです。最大購入数は{$stock}個です。"; ?></p>
  <?php elseif(isset($error) && $error == 'login'): ?>
    <p>恐れ入りますが、<a href="./user/login.php">ログイン</a>していただきますようお願いいたします</p>
  <?php endif; ?>
  <p>
    <input type="submit" name="now" value="今すぐ買う">
    <input type="submit" name="cart" value="カートに入れる">
  </p>
  <p><a href="./index.php">戻る</a></p>

   </body>
 </html>
