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
  #カートの内容と比較し、なければ$newをカートに追加
  print_r($_SESSION);
  $new = $_SESSION['new'] ?? array(); //送られてきた値
  $item_id = $new[count($new)-1]['item_id'] ?? ""; //送られてきた値のitem_id
  $cart = $_SESSION['cart'] ?? array(); //cartに保存してある値
  #cartにitem_idがあるか検索(array_columnでitem_idをkeyに代入し、array_keysでitem_idを取り出し配列にする)
  $item_ids = array_keys(array_column($cart,null,"item_id")) ?? "";
  // print_r($item_ids); //cartのitem_id一覧表示OK
  #item_idがitem_idsにあるかを調べる
  // var_dump(in_array($item_id, $item_ids)); //OK
  if (!in_array($item_id, $item_ids)) {
      #item_idが既存カートにないときの処理
      $cart = array_merge($new); #【エラー】動作しない
      unset($_SESSION['new']); #【エラー】更新しなければ動作しない
  } else {
      #item_idがある時の処理
      $error = "same_id"; //セッションを更新せず、cartとnewにデータを保存
      #カート内のデータを更新
      // $_SESSION['cart'][]
  }
  // $result = array_search()
  // var_dump($result);
  #idがなければcartにnewを追加
  // $_SESSION['cart'] = array_merge($_SESSION['new']);
  // $_SESSION['cart'][] = array_merge(array( "item_id" => 12, "p_num" => 4, "cart" => "カートに入れる"));//カートに配列を追加
  // unset($_SESSION['new']);
  // unset($_SESSION['cart']);
  // $_SESSION['new'][0]['item_id'] = 6; //IDの変更

  // print_r(in_array($count,$new));

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

    <?php //if(in_array($newPost['item_id'], $item_ids)):?>
      すでに登録されています
    <?php //else: ?>
      登録しました
    <?php //endif; ?>
     </p>
  </body>
</html>
