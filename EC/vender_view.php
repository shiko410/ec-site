<?php
require_once('./common/common.php');
require_once('./model/VenderViewModel.php');

$VenderViewModel = new VenderViewModel();
$VenderViewModel->main();

require_once('./view/vender_view.php');