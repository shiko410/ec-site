<?php
ini_set('display_errors', -1);
error_reporting(E_ALL);
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
require('../DB/dbconnect.php');
session_start();
# ログイン確認
if (isset($_SESSION['user']['id']) && $_SESSION ['user']['time'] + 3600 > time()) { #idがセッションに記録されている && 最後の行動から1時間以内
  //ログインしている
  $_SESSION['user']['time'] = time();
  $members = $pdo->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['user']['id']));
  $member = $members->fetch();
  print_r($_SESSION);
} else {
  //ログインしていない
  $login = "unlogin";
}

$message = '';
if(isset($_POST['confirm'])){  //確認ボタンを押してポストしたものなら
    $error_flg = false;
    //名前の必須入力チェック
    if ($_POST['name'] === ''){
        $message .= "お名前は必ず入力してください<br>";
        $error_flg = true;
    }
    //名前の必須入力チェック
    elseif ($_POST['mail'] === ''){
        $message .= "メールアドレスは必ず入力してください<br>";
        $error_flg = true;
    }
    //内容の必須入力チェック
    elseif ($_POST['content'] === ''){
        $message .= "お問い合わせ内容は必ず入力してください<br>";
        $error_flg = true;
    }

    //エラーが無ければ入力内容をセッションに保存して確認画面へ
    if (!$error_flg){
        $_SESSION['inquiry'] = $_POST;
        header('Location: ./confirm.php');
        exit();
    }
}

// 書き直し
if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'rewrite'){
    $_POST = $_SESSION['inquiry'];
}
$uer_id = $_SESSION['user']['id'] ?? "";
$stmt = $pdo->prepare('SELECT * FROM members WHERE id=?');
$stmt->execute(array($uer_id));
$member = $stmt->fetch();

?>
<!DOCTYPE html>
<html>
<head>
    <title>お問い合わせ - 入力画面</title>
</head>
<body>
<h1>お問い合わせ - 入力画面</h1>
<br>
<p style="color: red"><?php echo $message ?></p>  <!-- エラーメッセージ表示 -->
<form method="post" action="">
    <label for="name">お名前<span style="color: red">(必須)</span></label>
    <input type="text" name="name" id="name" value="
    <?php
      if(isset($_POST['name'])) {
        echo h($_POST['name']);
      } elseif (isset($member)) {
        echo h($member['name']);
      }
    ?>">
    <br>
    <label for="mail">ご連絡先(メールアドレス)<span style="color: red">(必須)</span></label>
    <input type="email" name="mail" id="mail" value="
    <?php
      if(isset($_POST['mail'])){
       echo h($_POST['mail']);
     } elseif(isset($member)) {
       echo h($member['email']);
     }
    ?>">
    <br>
    <label for="tel">ご連絡先(電話番号)</label>
    <input type="text" name="tel" id="tel" value="
    <?php
      if(isset($_POST['tel'])) {
        echo h($_POST['tel']);
      } elseif (isset($member)) {
        echo h($member['tel']);
      }
         ?>">
    <br>
    <label for="content">お問い合わせ内容<span style="color: red">(必須)</span></label>
    <textarea name="content" id="content"><?php if(isset($_POST['content'])) echo h($_POST['content']); ?></textarea>
    <br>
    <input type="submit" name="confirm" value="確認">
</form>
<p><a href="../index.php">トップへ戻る<a/></p>

</body>
</html>
