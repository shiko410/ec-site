<?php require('../DB/dbconnect.php'); ?>
<?php

?>


<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no ">
      <title>ログイン</title>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- StyleSheet -->
        <link rel="stylesheet" href="../CSS/form.css">
        <!-- jQuery Script -->
        <script type="text/javascript" src="./jQuery/jquery.js"></script>
        <script type="text/javascript" src="./JS/main.js"></script>
  </head>
  <body>
    <!-- スタイルの設定 -->
      <div class="top">
        <h1><a href="../index.php">ECサイト</a></h1>
        <!-- ↑ セッションを削除するページへ編集予定 -->
      </div>
      <div id="wrap">
        <div class="box-inner">
          <div id="head">
            <h1>ログイン</h1>
          </div>
        <div id="content">
      <!-- スタイルの設定 終わり -->

        <form action="" method="post">
          <dl>
            <dt>メールアドレス</dt>
            <dd>
              <input type="text" name="email" size="45" maxlength="255" value="">
            </dd>
            <dt>パスワード</dt>
            <dd>
              <input type="text" name="password" size="45" maxlength="255" value="">
            </dd>
            <dt>ログイン情報の記録</dt>
            <dd>
              <input id="save" type="checkbox" name="save" value="on"><label for="save">次回から自動的にログインする</label>
            </dd>
          </dl>
          <div class="input_wrap"><input type="submit" value="ログインする"></div>
        </form>



        </div>
        </div>
      </div>

  </body>
</html>
