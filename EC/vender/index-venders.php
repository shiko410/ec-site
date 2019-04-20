<?php require('../DB/dbconnect.php'); ?>

<?php
session_start();
//$_SESSIONのidの有無、$_SESSIONの時間
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  //ログインしている
  $_SESSION['time'] = time();

  $venders = $pdo->prepare('SELECT * FROM venders WHERE id=? ');
  $venders->execute(array($_SESSION['id']));
  $vender = $venders->fetch();
} else {
  //ログインしていないときの処理
  header('Location: ./login.php');
}

#投稿を記録する
if(!empty($_POST)) {  #登録ボタンがクリックされたら以下を実行
  if ($_POST['info'] != '') {
		$info = $pdo->prepare('INSERT INTO items SET vender_id=?, item=?, price=?, stock=?, info=?, created=NOW()');
		$info->execute(array(
			$vender['id'],
			$_POST['item'],
      $_POST['price'],
			$_POST['stock'],
			$_POST['info']
		));

    header('Location: index-venders.php'); exit();
  }
}
print_r($vender);

#ページ数を計算する→最終投稿数を計算
// $records = $pdo->query('SELECT COUNT(*) FROM items');
$records = $pdo->query('SELECT COUNT(*) AS record_count FROM items');
$record = $records->fetch();


#URLパラメータの値を取得
# 問題：idでデータを引っ張ってくるため、編集した場合、最新のデータが読み込めない
$items = $pdo->prepare('SELECT * FROM items WHERE id=? ');
$items->bindParam(1, $record['record_count']);
$items->execute();

print_r($items);

//
// print_r($item);

?>

<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>投稿場面</title>
    <link rel="stylesheet" href="../CSS/form.css">
  </head>
  <body>
    <div class="top">
      <h1><a href="../index.php">ECサイト</a></h1>
    </div>
    <div id="wrap">
      <p><?php echo h($vender['name']); ?>さん、ようこそ</p>
      <div id="head">
        <h1>投稿画面</h1>
      </div>
      <div id="content">

      </div>
      <!-- actionが空になっているので、現在のページに送信される -->
      <form action="" method="post">
        <dl>
          <dt>商品名</dt>
          <dd>
            <input type="text" name="item" size="45" value="">
          </dd>
          <dt>価格</dt>
          <dd>
            <input type="text" name="price" size="45" value="">
          </dd>
          <dt>在庫</dt>
          <dd>
            <input type="text" name="stock" size="45" value="">
          </dd>
          <dt>詳細</dt>
          <dd>
            <textarea name="info" rows="5" cols="45"></textarea>
          </dd>
        </dl>
        <div>
          <input type="submit" value="登録する">
        </div>
      </form>
      <div class="detail">
        <p>
          <a href="view.php?id=
            <?php print($items['id']); ?>
          ">詳細画面へ</a>
        </p>
      </div>
    </div>
  </body>
</html>
