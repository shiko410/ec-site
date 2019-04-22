<?php
//エラー強制出力
ini_set('display_errors', 1);
error_reporting(E_ALL);
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
require('../DB/dbconnect.php');
session_start();
#セッション情報を削除
$_SESSION = array();

?>
<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<p>ログアウトしました。</p>
<p><a href="../index.php">戻る</a></p>
  </body>
</html>
