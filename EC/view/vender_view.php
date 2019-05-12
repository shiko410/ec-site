<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
		<?php
		    #DBデータ($item)を変数($info)に格納
		    foreach ($VenderViewModel->item as $info):
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
			<a href="./vender_item_post.php">投稿画面へ</a>
		</p>
		<p>
			<a href="./vender_account.php">戻る</a>
		</p>
	</div>
	<!-- ページング -->
	<div class="next">
		<?php if($VenderViewModel->page >= 2): ?>
			<a href="vender_view.php?page=<?php print($VenderViewModel->page-1); ?>"><?php print($VenderViewModel->page - 1); ?>ページ目へ</a>
		<?php endif; ?>
		 	|
		<?php if($VenderViewModel->max_page()): ?>
			<a href="vender_view.php?page=<?php print($VenderViewModel->page+1); ?>"><?php print($VenderViewModel->page + 1); ?>ページ目へ</a>
		<?php endif; ?>
	</div>
	<p>
		<a href="./view_all.php">全件を表示</a>
	</p>
  </body>
</html>