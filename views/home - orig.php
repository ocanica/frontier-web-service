<?php
// Store $home to later render to HTML
$canvas = '';
// $output variable to store the HTML for the page
$output = '';
// Content to be render in #client-username
$client_username = 'BLACK';

switch((isset($_GET['type']) ? $_GET['type'] : '')) {
    case 'login' :
        $canvas .= file_get_contents(__DIR__ .'/../views/login.php');
        break;
    case 'sign_up' :
        $canvas .= file_get_contents(__DIR__ .'/../views/sign_up.php');
        break;
    case 'dashboard' :
        $canvas .= file_get_contents(__DIR__ .'/../views/dashboard.php');
        break;
    default :
        $canvas .= file_get_contents(__DIR__ .'/../views/landing.php');
}

/*
	Open Saved Images and Render Gallery Canvas
	-----------------------------------------------------------------------------
*/
// Collects all *qualifying* files in the /images/ dir and saves to array

// Set the title
$page_title = 'Frontier - Inclusive Worldwide Money Transfers';
// Content to be render in <h2> tag
$page_heading = 'Frontier';

$page_contents = $canvas;



//load on call
$rates_table = isset($_GET['type']) && $_GET['type'] == '' ? rates_table() : 'Rates table failed to render';

/*if(isset($_GET['id'])=='submitLogin') {
    login();
    $canvas .= file_get_contents(__DIR__ .'/../views/dashboard.php');
}*/



// Replace the template tags with the relevant strings
$head_pass = str_replace('[+page_title+]', $page_title, $tpl_head);
$head = str_replace('[+page_heading+]', $page_heading, $head_pass);
$pass0 = str_replace('[+page_heading+]', $page_heading, $tpl_home );
$pass1 = str_replace('[+page_contents+]', $page_contents, $pass0 );
$pass2 = str_replace('[+rates_table+]', $rates_table, $pass1 );
$final = str_replace('[+client_username+]', $client_username, $pass2);

// Concatenate the contents of the head and body to output for rendering
$output .= $head . $final;


?>