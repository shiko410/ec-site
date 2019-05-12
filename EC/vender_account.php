<?php
require_once('./common/common.php');
require_once('./model/VenderAccountModel.php');

$VenderAccountModel = new VenderAccountModel();
$VenderAccountModel->main();

require_once('./view/vender_account.php');