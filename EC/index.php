<?php
require('./DB/dbconnect.php');
//エラー出力強制
ini_set( 'display_errors', 1 ); // エラーを画面に表示(1を0にすると画面上にはエラーは出ない)
//すべてのエラー表示
error_reporting( E_ALL );
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
?>
<?php
session_start();

if (isset($_SESSION['id']) && $_SESSION ['time'] + 3600 > time()) { #idがセッションに記録されている && 最後の行動から1時間以内
  //ログインしている
  $_SESSION['time'] = time();

  $members = $pdo->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();
} else {
  //ログインしていない
  // header('Location: login.php'); exit();
}
?>
<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no ">
      <title>ECサイト</title>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- StyleSheet -->
        <link rel="stylesheet" href="./CSS/style.css">
        <!-- jQuery Script -->
        <script type="text/javascript" src="./jQuery/jquery.js"></script>
        <script type="text/javascript" src="./JS/main.js"></script>
  </head>
  <body>
    <div id="wrapper">
<!-- トップ -->
    <div id="top">
      <nav class="toggle">
        <i class="fa fa-bars menu" aria-hidden="true"></i>
        <ul>
          <?php if(isset($_SESSION['id'])): ?>
          <li><?php echo h($member['name']); ?>さんようこそ</li>
          <?php else: ?>
          <li><a href="./user/login.php">ログイン<br/><span>login</span></a></li>
          <?php endif; ?>
          <li><a href="./vender/login.php">出店者の方へ<br/><span>tenants</span></a></li>
          <li><a href="#">問い合わせ<br/><span>outline</span></a></li>
        </ul>
      </nav>
      <img src="./images/top.png" alt="トップ画像" style="width: 100%; ">
      </div>
      <!-- メイン -->
      <div id="main">
        <div class="section-all">
          <div class="item-cover">
            <div class="item-pic"> <!-- 画像 -->
              <img src="item_pic/bento.jpg" alt="">
            </div>
            <div class="detail"> <!-- 詳細 -->
              <p>Bento</p>
            </div>
          </div>
        </div>


      </div>
    </div>
  </body>
</html>
