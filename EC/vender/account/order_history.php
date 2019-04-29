<?php
require('../../DB/dbconnect.php');
session_start();
#ログイン確認
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  $_SESSION['time'] = time();
  $sql = 'SELECT * FROM venders WHERE id=?';
  $venders = $pdo->prepare($sql);
  $venders->execute(array($_SESSION['id']));
  $vender = $venders->fetch();
  print_r($vender);
}
?>
<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    #発注状況の呼び出し
    #buy:num, members:name, items: item, venders: id
    $sql1= 'SELECT m.name, v.name, i.item, b.p_number FROM members m, venders v, items i, buy b WHERE v.id=? AND b.members_id=m.id AND i.vender_id=v.id AND b.items_id=i.id';
    $stmt = $pdo->prepare($sql1);
    $stmt->execute(array(
      $_SESSION['vender']['id'],
    ));
    $res = $stmt->fetchALL();
    print_r($res);
    print_r($_SESSION);
    ?>
     <?php foreach ($res as $item): ?>
       <p>商品名：<?php echo h($item[2]); ?></p>
       <p>購入者：<?php echo h($item[1]); ?></p>
       <p>数量：<?php echo h($item[3]); ?></p>
       <hr>

     <?php endforeach; ?>

  </body>
</html>
