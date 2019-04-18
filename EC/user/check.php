<?php
//エラー出力強制
ini_set( 'display_errors', 1 ); // エラーを画面に表示(1を0にすると画面上にはエラーは出ない)
//すべてのエラー表示
error_reporting( E_ALL );
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
?>

<?php require('../DB/dbconnect.php'); ?>

<?php
session_start();

//$_SESSION['user']に何も含まれない場合、会員登録ページへ移動させる
if (!isset($_SESSION['user'])) {
  header('Location:signup.php');
  exit();
}

//登録処理をする
if (!empty($_POST)) { #登録ボタンが押されたら「true」→以下の処理を実施
  //DBにセッション情報を登録する
  // prepareメソッドではフォームで受け取った内容を指定する箇所を「?」と記述する。
  $stmt = $pdo->prepare('INSERT INTO members SET name=?, email=?, password=?, created=NOW()');
    echo $res = $stmt->execute(array(
        $_SESSION['user']['name'],
        $_SESSION['user']['email'],
        sha1($_SESSION['user']['password'])
    ));

    //セッションの削除
    unset($_SESSION['user']);
    header('Location:thanks.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- form.scc -->
    <link rel="stylesheet" href="../CSS/form.css">
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
      <div><a href="signup.php?action=rewrite">&laquo; &nbsp; 書き直す</a> | <input type="submit" value="登録する"></div>
    </form>


      <!-- スタイルの設定 -->
    </div>
    </div>
    </div>
  </body>
</html>
