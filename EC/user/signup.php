<?php
// //エラー出力強制
// ini_set( 'display_errors', 1 ); // エラーを画面に表示(1を0にすると画面上にはエラーは出ない)
// //すべてのエラー表示
// error_reporting( E_ALL );
// $_SESSION['token'] = session_id();
// header('X-FRAME-OPTIONS: DENY');
?>

<?php require('../DB/dbconnect.php'); ?>
<?php
session_start();
//フォームが空白でないか→フォームが送信されたかを確認
if (!empty($_POST)) {
  //エラー項目の確認
  if ($_POST['name'] == '') {
    $error['name'] = 'blank';
  }
  if ($_POST['email'] == '') {
    $error['email'] = 'blank';
  }
  if ($_POST['password'] == '') {
    $error['password'] = 'blank';
  }
  if (strlen($_POST['password']) < 4) {
    $error['password'] = 'length';
  }
  //エラーがないか確認する→なければチェックページへ
  if(empty($error)) {
    $_SESSION['user'] = $_POST;
    header('Location: check.php');
    exit();
  }
}
//書き直し
if ($_REQUEST['action'] == 'rewrite') {
  $_POST = $_SESSION['user'];
  $error['rewrite'] = true;
}

?>
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
            <dt>名前<span> *</span></dt>
            <!-- valueは書き直し時にデータの引き継ぎ -->
            <dd><input type="text" name="name" size="45" maxlength="255" value="<?php echo h($_POST['name']); ?>">
              <!-- 空白時にエラー表示 -->
              <?php if ($error['name'] == 'blank'): ?>
                <p class="error">※ 名前を入力してください </p>
              <?php endif; ?>
            </dd>

            <dt>メールアドレス<span> *</span></dt>
            <!-- valueは書き直し時にデータの引き継ぎ -->
            <dd><input type="text" name="email" size="45" maxlength="255" value="<?php echo h($_POST['email']); ?>">
            <!-- 空白時にエラー表示 -->
              <?php if ($error['email'] == 'blank'): ?>
                <p class="error">※ メールを入力してください </p>
              <?php endif; ?>
            </dd>

            <dt>パスワード<span> *</span></dt>
            <!-- valueは書き直し時にデータを引き継ぎ -->
            <dd><input type="password" name="password" size="45" maxlength="255" value="<?php echo h($_POST['password']); ?>">
              <!-- 空白時にエラー表示 -->
                <?php if ($error['password'] == 'blank'): ?>
                  <p class="error">※ パスワードを入力してください </p>
              <!-- 文字数が足りない時にエラー表示 -->
                <?php elseif ($error['password'] == 'length'): ?>
                  <p class="error">※ パスワードは4文字以上で入力してください</p>
                <?php endif; ?>
            </dd>


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
