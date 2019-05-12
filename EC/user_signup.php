<?php
require_once('./common/common.php');
require_once('./model/UserSignUpModel.php');

$UserSignUpModel = new UserSignUpModel();
$UserSignUpModel->main();

require_once('./view/user_signup.php');