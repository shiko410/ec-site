<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>アカウント情報</title>
    <!-- stylesheet -->
    <link rel="stylesheet" href="./CSS/form.css">
  </head>
  <body>
<!-- スタイルの設定 -->
      <div class="top">
        <h1><a href="./index.php">ECサイト</a></h1>
        <!-- ↑ セッションを削除するページへ編集予定 -->
      </div>
      <div id="wrap">
        <div class="box-inner">
          <div id="head">
            <h1>アカウント情報の変更</h1>
          </div>
        <div id="content">
<!-- スタイルの設定 終わり -->
<!-- 名前 -->
<form class="" action="./update.php?id=<?php print($UserAccountInfoModel->id);?>" method="post">
        <p> 名前： <?php print($UserAccountInfoModel->name); ?>
          <div style="text-align: right;">
          <input type="hidden" name="value" value="name">
          <input type="submit" name="edit" value="編集">
        </div>
        </p>
        <hr>
</form>

<!-- メールアドレス -->
      <form class="" action="./update.php?id=<?php print($UserAccountInfoModel->id);?>" method="post">
        <p> メールアドレス： <?php print($UserAccountInfoModel->email); ?>
          <div style="text-align: right;">
            <input type="hidden" name="value" value="email">
            <input type="submit" name="edit" value="編集">
          </div>
        </p>
        <hr>
      </form>
<!-- パスワード -->
      <form class="" action="./update_password.php?id=<?php print($UserAccountInfoModel->id);?>" method="post">
        <p> パスワード：【表示されません】
          <div style="text-align: right;">
            <input type="hidden" name="value" value="password">
            <input type="submit" name="edit" value="編集">
          </div>
        </p>
        <hr>
      </form>
<!-- 住所 -->
      <form class="" action="./update_add.php?id=<?php print($UserAccountInfoModel->id);?>" method="post">
        <p> 住所： <?php print($UserAccountInfoModel->address); ?>
          <div style="text-align: right;">
            <input type="hidden" name="value" value="address">
            <input type="submit" name="edit" value="編集">
          </div>
        </p>
        <hr>
      </form>
<!-- 電話番号 -->
      <form class="" action="./update.php?id=<?php print($UserAccountInfoModel->id);?>" method="post">
        <p> 電話番号： <?php print($UserAccountInfoModel->tel); ?>
          <div style="text-align: right;">
            <input type="hidden" name="value" value="tel">
            <input type="submit" name="edit" value="編集">
          </div>
        </p>
        <hr>
      </form>
<!-- カード情報 -->
      <form class="" action="./update_card.php?id=<?php print($UserAccountInfoModel->id);?>" method="post">
        <p> カード情報： 【表示されません】
          <div style="text-align: right;">
          <input type="hidden" name="value" value="card">
          <input type="submit" name="edit" value="編集">
          </div>
        </p>
      </form>
<!--スタイル設定 -->
    </div>
    </div>
  </div>
  <p style="width: 350px; margin: 20px auto;"><a href="./user_account.php">戻る</a></p>
<!-- スタイル設定終わり -->

  </body>
</html>