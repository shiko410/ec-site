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
          <?php if (isset($_SESSION['user']['id']) && $_SESSION['user']['time'] + 3600 > time()): ?>
          <li><?php echo h($IndexModel->name); ?>さんようこそ</li>
          <li><a href="./user_account.php">アカウント情報</a></li>
          <?php else: ?>
          <li><a href="./user_login.php">ログイン<br/><span>login</span></a></li>
          <?php endif; ?>
          <li><a href="./vender_login.php">出店者の方へ<br/><span>tenants</span></a></li>
          <li><a href="./inquiry.php">問い合わせ<br/><span>outline</span></a></li>
          <?php if(isset($_SESSION['user']['id'])): ?>
          <li><a href="./user/logout.php">ログアウト</a></li>
          <?php endif; ?>
        </ul>
      </nav>
      <img src="./images/top.png" alt="トップ画像" style="width: 100%; ">
      </div>
      <!-- メイン -->
      <?php foreach ($IndexModel->items as $item): ?>
      <div id="main">
        <div class="section-all">
          <a href="detail.php?id=<?php echo h($item['id']); ?>">
          <div class="item-cover">
            <div class="item-pic"> <!-- 画像 -->
              <img src="item_pic/bento.jpg" alt="" style="width: 300px;">
            </div>
            <div class="detail"> <!-- 詳細 -->
              <!-- 商品名 -->
              <p><?php echo h($item['item']); ?></p>
              <p><?php echo h($item['price']); ?>円</p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      </a>
      </div>
    </div>
  </body>
</html>