<?php

// セッション開始
session_start();

$count       = 1;

if (isset($_SESSION['a']) === TRUE) {
    $count = $_SESSION['a'] + 1;
}

$_SESSION['a']   = $count;
print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>セッション</title>
</head>
<body>
<?php if ($count > 1) { ?>
    <p>合計<?php print $count;?>回目のアクセスです</p>
<?php } else { ?>
    <p>初めてのアクセスです</p>
<?php } ?>

    <form action="practice_do.php" method="post">
        <input type="submit" value="更新">
    </form>
    <form action="session_delete.php" method="post">
        <input type="submit" value="履歴削除">
    </form>
</body>
</html>
