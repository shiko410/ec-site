<?php
ini_set('display_errors', -1);
error_reporting(E_ALL);
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
require('../DB/dbconnect.php');
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
?>
<!DOCTYPE html>
<html>
<head>
    <title>お問い合わせ - 完了画面</title>
</head>

<body>
<h1>お問い合わせ完了</h1>
<br>
<p>お問い合わせ内容を送信いたしました。管理人が確認次第、記入いただいた連絡先へ連絡いたしますのでお待ちください。</p>
<p><a href="../index.php">トップへ戻る<a/></p>

</body>
</html>
