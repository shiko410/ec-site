<?php require('../DB/dbconnect.php'); ?>

<?php
session_start();
//$_SESSIONのidの有無、$_SESSIONの時間
if (isset ($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
	//ログインしている
	$_SESSION['time'] = time();

	$venders = $pdo->prepare('SELECT * FROM venders WHERE id=?');
	$venders->execute(array($_SESSION['id']));
	$vender = $venders->fetch();
} else {
	//ログインしていないときの処理
	header('Location: ./login.php');
}


//DB内容を取得する
$items = $pdo->query('SELECT v.name, i.* FROM venders v, items i WHERE v.id=i.vender_id ORDER BY i.created DESC');

print_r($items);

?>

<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>
