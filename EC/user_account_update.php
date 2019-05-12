<?php
require_once('./common/common.php');
require_once('./model/UserAccountUpdateModel.php');

$UserAccountUpdateModel = new UserAccountUpdateModel();
$UserAccountUpdateModel->main();

require_once('./view/user_account_update.php');