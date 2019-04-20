<?php require('../DB/dbconnect.php'); ?>

<?php
session_start();
//$_SESSIONのidの有無、$_SESSIONの時間
if (isset ($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
	//ログインしている
	$_SESSION['time'] = time();

	$venders = $pdo->prepare('SELECT * FROM venders WHERE id=?');
	$venders->execute(array($_SESSION['id']));
	$vender = $venders->fetch();
} else {
	//ログインしていないときの処理
	header('Location: ./login.php');
}


#DB内容を取得する
//$items = $pdo->query('SELECT v.name, i.* FROM venders v, items i WHERE v.id=i.vender_id ORDER BY i.created DESC');
#DBから5件分のデータを取得する
//URLパラメータは前のページ(index-venders.php)で指定
$items = $pdo->query('SELECT v.name, i.* FROM venders v, items i WHERE v.id=i.vender_id ORDER BY i.created DESC LIMIT ?,5');
//bindParam(パラメータ「?」の順番, 値, 型)
$items->bindParam(1, $_REQUEST['page'], PDO::PARAM_INT);
$items->execute();
print_r($items);

?>
<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
		<?php
		#DBデータ($items)を変数($info)に格納
		 foreach ($items as $info):
			?>
		<div class="item"> <!-- #商品 -->
			<p>
				商品名：<?php echo h($info['item']); ?>
			</p>
		</div>
		<div class="price"> <!-- #価格 -->
			<p>
				価格：<?php echo h($info['price']); ?>円
			</p>
		</div>
		<div class="info">
			<p>
				詳細：<?php echo h($info['info']); ?>
				<span class="name">(
					<?php echo h($info['name']); ?>
				)</span></p>
			<p class="day">
				<?php echo h($info['created']); ?>
			</p>
		</div>
		<div class="return">
			<p>
				<a href="./edit.php">編集画面へ</a>
			</p>
		</div>
		<hr>
	<?php endforeach; ?>
	<div class="return">
		<p>
			<a href="./index-venders.php">投稿画面へ戻る</a>
		</p>
	</div>
  </body>
</html>
