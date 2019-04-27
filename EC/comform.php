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

#データの更新
#購入数（DB-購入数）で更新
$stock = $item['stock'] - $_SESSION['buy']['buy'];
$_SESSION['item_id'] = $_REQUEST['id'];
if (!empty($_POST)) {
  #table:items
  $sql1 = 'UPDATE items SET stock=?  WHERE id=?';
  $buys = $pdo->prepare($sql1);
  $buy = $buys->execute(array(
    $stock,
    $_SESSION['item_id']
  ));
  #table:buy
  $stmt = $pdo->prepare('INSERT INTO buy SET members_id=? items_id=? p_number=? created=NOW()');
  $res = $stmt->execute(array(
    $_SESSION['id'],
    $_SESSION['item_id'],
    $_POST['buy']
  ));
  header('Location: thanks.php');
  exit();
}
 ?>
 <!DOCTYPE html>
 <html lang="jp" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <?php print_r($_SESSION); ?>
     <p>商品名：<?php echo $item['item']; ?></p>
     <p>価格：<?php echo $item['price']; ?>円</p>
     <p>購入数：<?php echo $_SESSION['buy']['buy']; ?>個</p>
     <?php
     $total = $_SESSION['buy']['buy'] * $item['price'];
      ?>
     <p>合計金額：<?php echo $total; ?>円</p>
     <form class="" action="" method="post">
       <input type="hidden" name="buy" value="<?php echo $_SESSION['buy']['buy']; ?>">
       <input type="submit" name="" value="確定する">
     </form>

   </body>
 </html>
