<?php
require_once('./common/common.php');
require_once('./model/IndexModel.php');

$IndexModel = new IndexModel();
$IndexModel->main();

require_once('./view/index.php');