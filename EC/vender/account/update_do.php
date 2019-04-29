<?php
//エラー強制出力
ini_set('display_errors', 1);
error_reporting(E_ALL);
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
#SQL接続
require('../../DB/dbconnect.php');
session_start();
 ?>
 <!DOCTYPE html>
 <html lang="jp" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>確認画面</title>
   </head>
   <body>
<?php
#変更しないデータをDBから呼び出す
$venders = $pdo->prepare('SELECT * FROM venders WHERE id=?');
$venders->execute(array($_SESSION['vender']['id']));
$vender = $venders->fetch();
#POSTで送信された値だけデータを入れ替える。
$name = $_POST['name'] ?? $vender['name'];
$email = $_POST['email'] ?? $vender['email'];
$tel = $_POST['tel'] ?? $vender['tel'];
#データを更新する
$stmt = $pdo->prepare('UPDATE venders SET name=?, email=?, tel=? WHERE id=?');
$stmt->execute(array(
  $name,
  $email,
  (INT)$tel,
  $_SESSION['vender']['id']
));

?>
<p>内容を変更しました</p>
<p>
  <a href="account-info.php">戻る</a>
</p>

   </body>
 </html>
