<?php
try {
  $pdo = new PDO('mysql:dbname=shop; host=localhost; charset=utf8','root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo '接続に成功しました';
} catch (PDOException $e) {
  // echo "DB接続エラー：", $e->getMessage;
}
// htmlspecialcharsのショートカット
function h($value) {
	return htmlspecialchars($value, ENT_QUOTES);
}
?>
