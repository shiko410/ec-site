<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- form.scc -->
    <link rel="stylesheet" href="./CSS/form.css">
    <!-- jQuery Script -->
    <script type="text/javascript" src="../JS/main.js"></script>
    <script type="text/javascript" src="../jQuery/jquery.js"></script>
    <title>確認画面</title>
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
        <h1>確認画面</h1>
      </div>
    <div id="content">
  <!-- スタイルの設定 終わり -->


    <form action="" method="post">
      <input type="hidden" name="action" value="submit">
      <dl>
        <dt>名前</dt>
        <dd>
         <?php echo h($_SESSION['user']['name']); ?>
        </dd>
        <dt>メールアドレス</dt>
        <dd>
         <?php echo h($_SESSION['user']['email']); ?>
        </dd>
        <dt>パスワード</dt>
        <dd>【表示されません】</dd>
        <dt>写真など</dt>
        <dd></dd>
      </dl>
      <div><a href="user_signup.php?action=rewrite">&laquo; &nbsp; 書き直す</a> | <input type="submit" value="登録する"></div>
    </form>


      <!-- スタイルの設定 -->
    </div>
    </div>
    </div>
  </body>
</html>
