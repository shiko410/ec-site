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
$members = $pdo->prepare('SELECT * FROM members WHERE id=?');
$members->execute(array($_SESSION['id']));
$member = $members->fetch();
#POSTで送信された値だけデータを入れ替える。
$name = $_POST['name'] ?? $member['name'];
$email = $_POST['email'] ?? $member['email'];
$tel = $_POST['tel'] ?? $member['tel'];
#データを更新する
$stmt = $pdo->prepare('UPDATE members SET name=?, email=?, password=?, tel=? WHERE id=?');
$stmt->execute(array(
  $name,
  $email,
  (INT)$tel,
  $_SESSION['id']
));

?>
<p>内容を変更しました</p>
<p>
  <a href="account-info.php">戻る</a>
</p>
<p>確認</p>

   </body>
 </html>
