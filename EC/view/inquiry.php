<!DOCTYPE html>
<html>
<head>
    <title>お問い合わせ - 入力画面</title>
</head>
<body>
<h1>お問い合わせ - 入力画面</h1>
<br>
<p style="color: red"><?php echo $InquiryModel->message; ?></p>  <!-- エラーメッセージ表示 -->
<form method="post" action="">
    <label for="name">お名前<span style="color: red">(必須)</span></label>
    <input type="text" name="name" id="name" value="<?php if(isset($_POST['name'])) {echo h($_POST['name']);} elseif ($InquiryModel->member !== "") {echo h($InquiryModel->name);} ?>">
    <br>
    <label for="mail">ご連絡先(メールアドレス)<span style="color: red">(必須)</span></label>
    <input type="email" name="mail" id="mail" value="<?php if(isset($_POST['mail'])){echo h($_POST['mail']);} elseif($InquiryModel->member !== "") {echo h($InquiryModel->email);} ?>">
    <br>
    <label for="tel">ご連絡先(電話番号)</label>
    <input type="text" name="tel" id="tel" value="<?php if(isset($_POST['tel'])) {echo h($_POST['tel']);} elseif ($InquiryModel->member !== "") {echo h($InquiryModel->tel);} ?>">
    <br>
    <label for="content">お問い合わせ内容<span style="color: red">(必須)</span></label>
    <textarea name="content" id="content"><?php if(isset($_POST['content'])) echo h($_POST['content']); ?></textarea>
    <br>
    <input type="submit" name="confirm" value="確認">
</form>
<p><a href="./index.php">トップへ戻る<a/></p>

</body>
</html>
