<?php
require_once('./common/common.php');
require_once('./model/VenderLoginModel.php');

$VenderLoginModel = new VenderLoginModel();
$VenderLoginModel->main();

require_once('./view/vender_login.php');