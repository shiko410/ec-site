<?php
require_once('./common/common.php');
require_once('./model/UserAccountInfoModel.php');

$UserAccountInfoModel = new UserAccountInfoModel();
$UserAccountInfoModel->main();

require_once('./view/user_account_info.php');