<?php
require_once('./common/common.php');
require_once('./model/UserCheckModel.php');

$UserCheckModel = new UserCheckModel();
$UserCheckModel->main();

require_once('./view/user_check.php');