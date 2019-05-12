<?php
require_once('./common/common.php');
require_once('./model/UserLoginModel.php');

$UserLoginModel = new UserLoginModel();
$UserLoginModel->main();

require_once('./view/user_login.php');