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
#メールの送信
// $to = "shikou.tamai@gmail.com";
// $subject = "TEST MAIL";
// $message = "Hello!\r\nThis is TEST MAIL.";
// $headers = "From: from@samurai.jp";
// mail($to, $subject, $message, $headers);
$message = "";
if (isset($_POST['send'])){
    //メール送信
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");

    $email = "";     // 送信元メール(用意しているサーバのもの(好きなもので良い))
    $subject = "お問い合わせがありました"; // 題名
    $to = 'shikou.tamai@gmail.com';           // 送信先メール(個人のメール)
    $header = "From: ". mb_encode_mimeheader("お問い合わせ通知") . "<$email>";
    $body =
        "
        以下の内容によるお問い合わせがありました。\n
        [お名前]\n
        {$_SESSION['inquiry']['name']}\n
        [ご連絡先(メールアドレス)]\n
        {$_SESSION['inquiry']['mail']}\n
        [ご連絡先(電話番号)]\n
        {$_SESSION['inquiry']['tel']}\n
        [お問い合わせ内容]\n
        {$_SESSION['inquiry']['content']}\n
        ";
    $result = mb_send_mail($to, $subject, $body, $header);

    //送信結果
    if ($result){
        //セッション削除
        unset($_SESSION['inquiry']);
        //完了画面へ
        header('Location: complete.php');
        exit;
    }
    else {
        $message = "お問い合わせ送信に失敗しました。";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>お問い合わせ - 確認画面</title>
</head>

<body>
<h1>お問い合わせ - 確認画面</h1>
<br>
<p style="color: red"><?php echo $message ?></p>
<form method="post" action="confirm.php">
    <p>
        [お名前]<br>
        <?php echo htmlspecialchars($_SESSION['inquiry']['name']); ?>
    </p>
    <p>
        [ご連絡先(メールアドレス)]<br>
        <?php echo htmlspecialchars($_SESSION['inquiry']['mail']); ?></p>
    <p>
        [ご連絡先(電話番号)]<br>
        <?php echo htmlspecialchars($_SESSION['inquiry']['tel']); ?></p>
    <p>
        [お問い合わせ内容]<br>
        <?php echo htmlspecialchars($_SESSION['inquiry']['content']); ?></p>
    <br>
    <input type="submit" name="send" value="送信">
</form>
<div><a href="inquiry.php?action=rewrite">&laquo;&nbsp;書き直す</a>

</body>
</html>
