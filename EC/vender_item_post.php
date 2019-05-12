<?php
require_once('./common/common.php');
require_once('./model/VenderItemPost.php');

$VenderItemPost = new VenderItemPost();
$VenderItemPost->main();

require_once('./view/vender_item_post.php');