<?php
require_once('./common/common.php');
require_once('./model/DetailModel.php');

$DetailModel = new DetailModel();
$DetailModel->main();

require_once('./view/detail.php');