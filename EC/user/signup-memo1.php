<?php require('../DB/dbconnect.php'); ?>

<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- StyleSheet -->
    <link rel="stylesheet" href="../CSS/form.css">
    <!-- jQuery Script -->
    <script type="text/javascript" src="../JS/main.js"></script>
    <script type="text/javascript" src="../jQuery/jquery.js"></script>
    <title>ECサイト-会員登録</title>
  </head>
  <body>
    <div class="top">
      <h1><a href="../index.php">ECサイト</a></h1>
    </div>
    <div id="wrap">
      <div class="box-inner">
      <div id="head">
        <h1>会員登録</h1>
      </div>
      <div id="content">
        <form  action="" method="post" enctype="multipart/form-data">
          <dl>
            <dt>名前<span>必須</span></dt>
            <dd><input type="text" name="name" size="45" maxlength="255" value=""></dd>
            <dt>メールアドレス<span>必須</span></dt>
            <dd><input type="text" name="email" size="45" maxlength="255" value=""></dd>
            <dt>パスワード<span>必須</span></dt>
            <dd><input type="password" name="password" size="45" maxlength="255"></dd>
            <dt>写真など</dt>
            <dd><input type="file" name="image" size="45"></dd>
          </dl>
          <div class="submit">
            <input type="submit" value="入力内容を確認する">
          </div>
        </form>
      </div>
    </div>
    </div>
  </body>
</html>
