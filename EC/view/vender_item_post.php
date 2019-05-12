<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>投稿場面</title>
    <link rel="stylesheet" href="./CSS/form.css">
  </head>
  <body>
    <div class="top">
      <h1><a href="./index.php">ECサイト</a></h1>
    </div>
    <div id="wrap">
      <p><?php echo h($VenderItemPost->name); ?>さん、ようこそ</p>
      <div id="head">
        <h1>投稿画面</h1>
      </div>
      <div id="content">
        <div class="box-inner">


      <!-- actionが空になっているので、現在のページに送信される -->
      <form action="" method="post">
        <dl>
          <dt>商品名</dt>
          <dd>
            <input type="text" name="item" size="45" value="" required/>
          </dd>
          <dt>価格</dt>
          <dd>
            <input type="text" name="price" size="45" value="" required/>
            <?php if(isset($VenderItemPost->error['price']) && $VenderItemPost->error['price'] == 'num'): ?>
              <p class="error">半角の数値でご入力ください</p>
            <?php endif; ?>
          </dd>
          <dt>在庫</dt>
          <dd>
            <input type="text" name="stock" size="45" value="" required/>
            <?php if(isset($VenderItemPost->error['stock']) && $VenderItemPost->error['stock'] == 'num'): ?>
              <p class="error">半角の数値でご入力ください</p>
            <?php endif; ?>
          </dd>
          <dt>詳細</dt>
          <dd>
            <textarea name="info" rows="5" cols="45"></textarea>
          </dd>
        </dl>
        <div class="input_wrap">
          <input type="submit" value="登録する">
        </div>
      </form>
      <div class="detail">
        <p>
          <a href="vender_view.php">詳細画面へ</a>
        </p>
        <p>
          <a href="./vender_account.php">戻る</a>
        </p>

      </div>
      </div>
    </div>
    </div>
  </body>
</html>