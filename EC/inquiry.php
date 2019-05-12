<?php
require_once('./common/common.php');
require_once('./model/InquiryModel.php');

$InquiryModel = new InquiryModel();
$InquiryModel->main();

require_once('./view/inquiry.php');