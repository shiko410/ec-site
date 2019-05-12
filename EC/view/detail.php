<!DOCTYPE html>
<html lang="jp" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>商品情報</title>
</head>
<body>
<div class="" style="border: 1px solid #333;">
  <p>商品情報</p>
  <p><?php echo h($DetailModel->item['info']); ?></p>
</div>
<p><?php echo h($DetailModel->item['item']); ?></p>
<p>価格：<?php echo h($DetailModel->item['price']); ?>円</p>
<form class="" action="" method="post">
<input type="hidden" name="item_id" value="<?php echo $_REQUEST['id'] ?>">
数量：<input type="number" name="p_num" value="<?=$_POST["[p_num]"]??""?>" placeholder="">
<?php if ($DetailModel->error == 'blank'): ?>
  <p>購入数が入力されていません。購入数を正しく入力してください。</p>
<?php elseif($DetailModel->error == 'num'): ?>
  <p>購入数を正しく入力してください。</p>
<?php elseif($DetailModel->error == 'exceed'): ?>
  <p><?php echo "申し訳ございませんが、数量オーバーです。最大購入数は{$DetailModel->stock}個です。"; ?></p>
<?php elseif($DetailModel->error == 'login'): ?>
  <p>恐れ入りますが、<a href="./user/login.php">ログイン</a>していただきますようお願いいたします</p>
<?php elseif($DetailModel->message != ""): ?>
  <p><?=$DetailModel->message?></p>
<?php endif; ?>
<p>
  <input type="submit" name="now" value="今すぐ買う">
  <input type="submit" name="cart" value="カートに入れる">
</p>
<p><a href="./index.php">戻る</a></p>
</body>
</html>