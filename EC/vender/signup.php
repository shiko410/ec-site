<?php
//エラー出力強制
ini_set( 'display_errors', 1 ); // エラーを画面に表示(1を0にすると画面上にはエラーは出ない)
//すべてのエラー表示
error_reporting( E_ALL );
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
#sql接続
require('../DB/dbconnect.php');
session_start();
//フォームに正しい値が入力されているか確認する
  if (!empty($_POST)) {
    if ($_POST['name'] == '') {
      $error['name'] = 'blank';
    }
    if ($_POST['email'] == '') {
      $error['email'] = 'blank';
    }
    #順番が重要① 4文字以下の時 → $error['password'] = 'length';
    if (strlen($_POST['password']) <4) {
            $error['password'] = 'length';
    }
    #$error['password'] = 'length'; の時で かつ ''の時 →$error['password'] = 'blank';に変数を書き換え
    if ($_POST['password'] == '') {
      $error['password'] = 'blank';
    }
    
    if (empty($error)) {
      $_SESSION['vender'] = $_POST;
      header('Location: check.php'); exit();
    }
  }
#エラー対策
$name = $_POST['name'] ?? "";
$email = $_POST['email'] ?? "";
$password = $_POST['password'] ?? "";

?>
<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>会員登録</title>
    <!-- stylesheet -->
    <link rel="stylesheet" href="../CSS/form.css">
    <!-- jQuery Script -->
    <script type="text/javascript" src="../JS/main.js"></script>
    <script type="text/javascript" src="../jQuery/jquery.js"></script>
  </head>

  <body>
    <div class="top">
      <h1><a href="../index.php">ECサイト</a></h1>
    </div>
    <div id="wrap">
      <div class="box-inner">
        <div id="head">
          <h1>出店者登録</h1>
        </div>
        <div id="content">
          <form  action="" method="post">
            <dl>

              <dt>名前<span> *</span></dt>
              <!-- valueは書き直し時にデータの引き継ぎ -->
              <dd><input type="text" name="name" size="47" maxlength="255" value="<?php echo h($name); ?>" >
              <!-- 空白時にエラー表示 -->
              <?php if (isset($error['name']) && $error['name'] = 'blank'): ?>
                <p class="error">※名前を入力してください</p>
              <?php endif; ?>
              </dd>

              <dt>メールアドレス<span>*</span></dt>
              <!-- valueは書き直し時にデータを引き継ぎ -->
              <dd><input type="text" name="email" size="47"  maxlength="255" value="<?php echo h($email); ?>">
              <!-- 空白時にエラー表示 -->
              <?php if (isset($error['email']) && $error['email'] == 'blank'): ?>
                <p class="error">※ メールアドレスを入力してください</p>
              <?php endif; ?>
              </dd>

              <dt>パスワード<span> *</span></dt>
              <dd>
                <input type="password" name="password" size="47" maxlength="255" value="<?php echo h($password); ?>">
                <!-- 空白時のエラー表示 -->
                <?php if (isset($error['password']) && $error['password'] == 'blank') : ?>
                  <p class="error">※ パスワードを入力してください</p>

								<?php elseif (isset($error['password']) && $error['password'] == 'length'): ?>
									<p class="error">※ パスワードは4文字以上で入力してください</p>

              <?php endif; ?>
              </dd>
            </dl>

            <!-- 送信ボタン -->
            <div class="submit">
              <input type="submit" name="" value="入力内容を確認する">
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
