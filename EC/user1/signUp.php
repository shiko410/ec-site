
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
if (isset($_SESSION['user1']) != "") {
  //ログイン済みの場合はリダイレクト
  header("Location: home.php");
}

//signupがPOSTされた時に下記を実行(bottomに$_POST['signup']を設定)
if (isset($_POST['signup'])) {
  $name = $pdo->real_escape_string($_POST['name']);
  $email = $pdo->real_escape_string($_POST['email']);
  $password = $pdo->real_escape_string($_POST['password']);
  $password = password_hash($password, PASSWORD_DEFAULT);

  //POSTされた情報をDBに格納する
  $query = "INSERT INTO users(name, email, password) VALUES ('$name', '$email', '$password')";

  if ($pdo->query($query)) { ?>
  <div class="alert alert-success" role="alert">登録しました</div>
  <?php } else { ?>
  <div class="alert alert-danger" role="alert">エラーが発生しました。</div>
  <?php
  }
}

?>

<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viweport" content="width=device-width, initial-scale=1">
    <title>ECサイト</title>
    <!-- StyleSheet -->
    <link rel="stylesheet" href="../CSS/form1.css">
    <!-- jQuery Script -->
    <script type="text/javascript" src="../JS/main.js"></script>
    <script type="text/javascript" src="../jQuery/jquery.js"></script>
    <!-- BootstrapのCSS読み込み -->
    <link href="../CSS/bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="../CSS/bootstrap-4.3.1-dist/js/bootstrap.min.js.map"></script>
  </head>
  <body>

    <div id="wrap">
      <div class="box-inner">
        <div id="head">
          <h1>会員登録</h1>
        </div>
      <div id="content">

        <form action="" method="post">
          <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="氏名" value="" required />
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="email" placeholder="メールアドレス" value="" required />
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="password" placeholder="パスワード" value="" required />
          </div>

          <button type="submit" name="signup">会員登録する</button>
          <a href="login.php">ログインはこちら</a>
        </form>
      </div>
      </div>
    </div>

  </body>
</html>
