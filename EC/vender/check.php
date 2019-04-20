<?php require('../DB/dbconnect.php'); ?>
<?php
session_start();

//$_SESSION['vender']の値がからの場合、登録ページへ移動
if (!isset($_SESSION['vender'])) {
  header('Location: signup.php');
  exit();
}

//登録処理をする
if(!empty($_POST)) {  #登録ボタンがクリックされたら以下を実行
// prepareメソッドではフォームで受け取った内容を指定する箇所を「?」と記述する。
  $stmt = $pdo->prepare('INSERT INTO venders SET name=?, email=?, password=?, created=NOW()');
  echo $res = $stmt->execute(array(
    $_SESSION['vender']['name'],
    $_SESSION['vender']['email'],
    sha1($_SESSION['vender']['password'])
  ));

  //セッションの削除
  unset($_SESSION['vender']);
  header('Location: thanks.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>確認画面</title>
    <!-- form.css -->
    <link rel="stylesheet" href="../CSS/form.css">
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
            <h1>出店者確認画面</h1>
          </div>
        <div id="content">
      <!-- スタイルの設定 終わり -->

      <form action="" method="post">
        <input type="hidden" name="action" value="submit">
          <dl>
            <dt>名前</dt>
            <dd>
              <?php echo h($_SESSION['vender']['name']); ?>
            </dd>
            <dt>メールアドレス</dt>
            <dd>
              <?php echo h($_SESSION['vender']['email']); ?>
            </dd>
            <dt>パスワード</dt>
            <dd>【表示されません】</dd>
          </dl>
        <div>
          <a href="signup.php?action=rewrite">&laquo; &nbsp; 書き直し</a> | <input type="submit" value="登録する">
        </div>
      </form>
      
      <!-- スタイル設定 -->
    </div>
    </div>
    </div>
    <!-- スタイル設定終了 -->
  </body>
</html>
