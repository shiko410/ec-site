<?php
require_once('./common/common.php');
require_once('./model/UserAccountModel.php');

$UserAccountModel = new UserAccountModel();
$UserAccountModel->main();

require_once('./view/user_account.php');