<?php
try {
  $dbl = new PDO('mysql:dbname=shop; host=localhost; charset=utf8','root', 'root');
  echo '接続に成功しました';
} catch (PDOException $e) {
  echo "DB接続エラー：", $e->getMessage;
}
// htmlspecialcharsのショートカット
function h($value) {
	return htmlspecialchars($value, ENT_QUOTES);
}
?>
