<?php
session_start();
$_SESSION['user']['cart'][] = $_POST;
$id = $_POST['id'] ?? "";
if (!empty($_POST)) {
  $id = (int)$id + 1;
}
#セッションに追加する
// var_dump($_SESSION);
if (!empty($_POST)) {
//  $_SESSION['user']['id'] =(int) $_SESSION['user']['id'] + 1;
}
#カート整理番号
print_r($_SESSION);
print_r($_POST);
// print_r($count);
$_SESSION = array();
?>
<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="practice.php" method="post">
      <input type="hidden" name="id" value="<?php $id ?>">
      <input type="number" name="num" value=""/>
      <input type="submit" name="" value="カートに入れる">
    </form>
  </body>
</html>
