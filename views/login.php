<?php
 require_once("./includes/login.inc.php");
ob_start();
$canvas = include($config['app_dir'].'/templates/login.php');
$output = ob_get_clean();
?>