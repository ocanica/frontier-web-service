<?php
//Session check - populate rates table only once per session avoiding multiple calls to currency rate server 
if(!isset($_SESSION['done'])) {
    $_SESSION['done']= true;
    include("./includes/pop_curr_table.inc.php");
}
call_user_elements();
call_head_curr_elements();
/*
had to assign ob_start() to variable as I was unable to pass str_replace() data 
*/
ob_start();
//Load currency rates table on call
$rates_table = rates_table();
//$rates_table = 'Hidden for now ;P';

$canvas = include($config['app_dir'].'/templates/dashboard.php');
$exch_mod = '';
$buffer = ob_get_contents();
ob_get_clean();

// Replace the template tags with the relevant strings
$buffer = str_replace('[+page_contents+]', $canvas, $buffer);
$buffer = str_replace('[+rates_table+]', $rates_table, $buffer);    

// Concatenate the contents of the head and body to output for rendering
$output = $buffer;
?>