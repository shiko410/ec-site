<?php
//エラー強制出力
//エラーを画面に表示(1を0にすると画面上にエラーが出ない)
ini_set('display_errors',1);
//すべてのエラーを表示
error_reporting( E_ALL);
$_SESSION['token'] = session_id();
header('X-FRAME-OPTIONS: DENY');
#SQL接続
require('../DB/dbconnect.php');

?>
<!DOCTYPE html>
<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<?php
  if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $stmt = $pdo->prepare('DELETE FROM items WHERE id=?');
    $stmt->execute(array($id));
  }
 ?>
   <p>メモを削除しました</p>
   <p><a href="view.php">戻る</a></p>
  </body>
</html>
