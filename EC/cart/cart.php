<?php
require('../DB/dbconnect.php');
session_start();
print_r($_SESSION);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <p>カート一覧</p>
    <?php foreach ($variable as $key => $value) {
      // code...
    } ?>
  </body>
</html>
