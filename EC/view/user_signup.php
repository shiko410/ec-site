<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- StyleSheet -->
    <link rel="stylesheet" href="./CSS/form.css">
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
            <dd><input type="text" name="name" size="45" maxlength="255" value="<?php echo h($UserSignUpModel->name); ?>">
              <!-- 空白時にエラー表示 -->
              <?php if (isset($UserSignUpModel->error['name']) && $UserSignUpModel->error['name'] == 'blank'): ?>
                <p class="error">※ 名前を入力してください </p>
              <?php endif; ?>
            </dd>

            <dt>メールアドレス<span> *</span></dt>
            <!-- valueは書き直し時にデータの引き継ぎ -->
            <dd><input type="text" name="email" size="45" maxlength="255" value="<?php echo h($UserSignUpModel->email); ?>">
            <!-- 空白時にエラー表示 -->
              <?php if (isset($UserSignUpModel->error['email']) && $UserSignUpModel->error['email'] == 'blank'): ?>
                <p class="error">※ メールを入力してください </p>
              <?php elseif(isset($UserSignUpModel->error['email']) && $UserSignUpModel->error['email'] == 'duplicate'): ?>
                <p class="error">※ 入力されたメールアドレスは登録済みです。 </p>
              <?php endif; ?>
            </dd>

            <dt>パスワード<span> *</span></dt>
            <!-- valueは書き直し時にデータを引き継ぎ -->
            <dd><input type="password" name="password" size="45" maxlength="255" value="<?php echo h($UserSignUpModel->password); ?>">
              <!-- 空白時にエラー表示 -->
                <?php if (isset($UserSignUpModel->error['password']) && $UserSignUpModel->error['password'] == 'blank'): ?>
                  <p class="error">※ パスワードを入力してください </p>
              <!-- 文字数が足りない時にエラー表示 -->
            <?php elseif (isset($UserSignUpModel->error['password']) && $UserSignUpModel->error['password'] == 'length'): ?>
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
