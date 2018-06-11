<?php
/*
old code - could not parse php code using file_get_contents() had to use output buffer to 'catch' all outputs   
$canvas = file_get_contents(__DIR__ .'/../templates/landing.html');
*/

ob_start();
//$canvas = include($_SERVER['DOCUMENT_ROOT'].'/templates/landing.php'); not allowable titan server path
$canvas = include($config['app_dir'].'/templates/landing.php');

$ob = ob_get_clean();

$output = $ob;
?>