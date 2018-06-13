<?php
require_once("./includes/sign_up.inc.php");
ob_start();
$canvas = include($config['app_dir'].'/templates/sign_up.php');
$output = ob_get_clean();
?>