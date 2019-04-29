<?php
//エラー出力強制
ini_set( 'display_errors', 1 ); // エラーを画面に表示(1を0にすると画面上にはエラーは出ない)
//すべてのエラー表示
error_reporting( E_ALL );
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
#sql接続
require('../../DB/dbconnect.php');
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
#ページング
$page = $_REQUEST['page'] ?? (INT)"1";
$start = 5 * ($page - 1);
#DB内容を取得する
// $items = $pdo->query('SELECT v.name, i.* FROM venders v, items i WHERE v.id=i.vender_id ORDER BY i.created DESC');
#DBから5件分のデータを取得する
//URLパラメータは前のページ(index-venders.php)で指定
if (isset($_REQUEST['page'])) {
$items = $pdo->prepare('SELECT v.name, i.* FROM venders v, items i WHERE v.id=i.vender_id ORDER BY i.modified DESC LIMIT ?,5');
//bindParam(パラメータ「?」の順番, 値, 型)
$items->bindParam(1, $start, PDO::PARAM_INT);
$items->execute();
print_r($items);
} else {
	$items = $pdo->query('SELECT v.name, i.* FROM venders v, items i WHERE v.id=i.vender_id ORDER BY i.modified DESC LIMIT 0, 5');
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
		#DBデータ($items)を変数($info)に格納
		 foreach ($items as $info):
			?>

		<div class="item"> <!-- #商品 -->
			<p>
				ID：<?php echo h($info['id']); ?>
			</p>
		</div>
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
				<a href="./update.php?id=<?php echo h($info['id']); ?>">編集画面へ</a>
				|
				<a href="./delete.php?id=<?php echo h($info['id']) ?>">削除する</a>
			</p>
		</div>
		<hr>
	<?php endforeach; ?>
	<div class="return">
		<p>
			<a href="./index-venders.php">投稿画面へ</a>
		</p>
		<p>
			<a href="./account.php">戻る</a>
		</p>
	</div>
	<!-- ページング -->
	<div class="next">
		<?php if($page >= 2): ?>
			<a href="view.php?page=<?php print($page-1); ?>"><?php print($page - 1); ?>ページ目へ</a>
		<?php endif; ?>
		 	|
		<?php
		$counts = $pdo->query('SELECT COUNT(*) AS cnt FROM items');
		$count = $counts->fetch();
		$max_page = floor($count['cnt'] / 5) + 1;
		if($page < $max_page) :
		 ?>
			<a href="view.php?page=<?php print($page+1); ?>"><?php print($page + 1); ?>ページ目へ</a>
		<?php endif; ?>
	</div>
	<p>
		<a href="./view_all.php">全件を表示</a>
	</p>
  </body>
</html>
