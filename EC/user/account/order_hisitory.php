<?php
require('../../DB/dbconnect.php');
session_start();
#ログイン確認
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  $_SESSION['time'] = time();
  $members = $pdo->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();
  print_r($_SESSION);
} else {
  header('Location: ../../index.php'); exit();
}
?>
<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="top">
      <h1><a href="../../index.php">ECサイト</a></h1>
      <!-- ↑ セッションを削除するページへ編集予定 -->
    </div>
    <p><?php echo h($member['name']); ?>さんの注文履歴</p>
    <?php
    #DBのmembersとitemsとbuyのリレーションから発注履歴を呼び出す
    $historys = $pdo->query('SELECT m.name, b.*, i.* FROM members m, buy b, items i WHERE m.id=b.members_id AND i.id=b.items_id;');
    // print_r($historys);
    $stm = $pdo->prepare('SELECT b.*, m.name, i.* FROM members m, buy b, items i WHERE b.members_id=? AND i.id=b.items_id');
    $stm->execute(array($_SESSION['id']));
    $items = $stm->fetch();
    print_r($items);
    // $items = $pdo->query('SELECT m.name, b.*, i.* FROM members m, buy b, items i WHERE m.id=b.members_id AND i.id=b.items_id');
    // print_r($items);
     ?>
     <?php foreach($items as $info): ?>
     <p>商品名：<?php echo h($info['item'])?></p>
       <p>
         購入数：<?php echo h($info['p_number']); ?>
       </p>
       <p>
         合計金額：<?php echo h($info['p_number'] * $info['price']); ?>
       </p>

     <?php endforeach; ?>
       <p style="width: 350px; margin: 20px auto;"><a href="./account.php">戻る</a></p>
  </body>
</html>
