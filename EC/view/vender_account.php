<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- stylesheer -->
    <link rel="stylesheet" href="./CSS/form.css">
  </head>
  <body>
<!-- スタイルの設定 -->
      <div class="top">
        <h1><a href="../../index.php">ECサイト</a></h1>
        <!-- ↑ セッションを削除するページへ編集予定 -->
      </div>
      <div id="wrap">
        <div class="box-inner">
          <div id="head">
            <h1><?php echo h($VenderAccountModel->name); ?>さんようこそ</h1>
          </div>
        <div id="content">
<!-- スタイルの設定 終わり -->

        <a href="./vender_item_post.php">
          <div class="box">
            <p>商品登録</p>
          </div>
        </a>

        <a href="./order_history.php">
          <div class="box">
            <p>注文履歴</p>
          </div>
        </a>
        <a href="./vender_view.php">
          <div class="box">
            <p>商品一覧</p>
          </div>
        </a>
        <a href="./account-info.php">
          <div class="box">
            <p>アカウント情報の変更</p>
          </div>
        </a>
        <a href="./payment.php">
          <div class="box">
            <p>口座の変更</p>
          </div>
        </a>
<!--スタイル設定 -->
    </div>
    </div>
  </div>
<!-- スタイル設定終わり -->
  </body>
</html>