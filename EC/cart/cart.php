<?php
require('../DB/dbconnect.php');
session_start();
#ログイン情報
if (isset($_SESSION['user']['id']) && $_SESSION['user']['time'] + 3600 > time()) {
  $_SESSION['user']['time'] = time();
  $members = $pdo->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['user']['id']));
  $member = $members->fetch();
  // print_r($_SESSION);
}
  #カート内の内容を取り出す
  print_r($_SESSION['cart']);
  $cart = array_column($_SESSION['cart'],null,"item_id");
  print_r(array_keys($cart));
  $item_id = array_keys($cart);
  // var_export(array_column($_SESSION['cart'],null));
  // var_dump(in_array($_SESSION['cart'],array_keys($cart)));
  #メモ
  // print_r(array_keys($cart));
  #$_SESSION['cart']をカウントし最新のPOSTを調べる
  $array_num = (count($_SESSION['cart'])-1);
  $new_session_id = $_SESSION['cart'][$array_num]['item_id'];
  $item_ids = unset($item_id[$array_num]);
  //$item_id = array_keys($cart); と同じ
  // foreach (array_keys($cart) as $value) {
  //   $item_id[] = $value;
  // }
  // print_r($item_id);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <p>ようこそ<?php echo $member['name']; ?>さん</p>
    <p>カート一覧</p>
    <p>
      <?php print_r($new_session_id); ?>
      <?php print_r($item_ids); ?>
    <?php if(in_array($new_session_id, $item_ids)):?>
      すでに登録されています
    <?php else: ?>
      登録しました
    <?php endif; ?>
     </p>
  </body>
</html>
