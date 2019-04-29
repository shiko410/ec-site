<?php
//エラー出力強制
ini_set( 'display_errors', 1 ); // エラーを画面に表示(1を0にすると画面上にはエラーは出ない)
//すべてのエラー表示
error_reporting( E_ALL );
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
require('../DB/dbconnect.php');
session_start();

  if (!empty($_POST)) { #送信ボタンを押された時
    //ログイン処理
    if ($_POST['email'] != '' && $_POST['password'] != '') {
      $login = $pdo->prepare('SELECT * FROM members WHERE email=? AND password=?');
      $login->execute(array(
        $_POST['email'],
        sha1($_POST['password'])
      ));
      $member = $login->fetch();

      //ログイン成功→
      if ($member) {
        $_SESSION['user']['id'] = $member['id'];
        $_SESSION['user']['time'] =time();

        header('Location:../index.php'); exit();
      } else {
        #ログイン失敗時の処理
        $error['login'] = 'failed';
      }
    } else {
      #空白時の処理
      $error['login'] = 'blank';
    }
  }

#エラー処理
$email = $_POST['eail'] ?? "" ;
$password = $_POST['password'] ?? "" ;
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
              <input type="text" name="email" size="45" maxlength="255" value="<?php echo h($email) ?>" required>
            </dd>
            <dt>パスワード</dt>
            <dd>
              <input type="text" name="password" size="45" maxlength="255" value="<?php echo h($password) ?>" required>
            </dd>
            <dt>ログイン情報の記録</dt>
            <dd>
              <input id="save" type="checkbox" name="save" value="on"><label for="save">次回から自動的にログインする</label>
            </dd>
          </dl>
          <div class="input_wrap"><input type="submit" value="ログインする"></div>
        </form>
        <p></p>
        <p>
          <a href="signup.php">新規登録</a>
        </p>

        </div>
        </div>
      </div>

  </body>
</html>
