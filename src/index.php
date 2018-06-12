<?php
/*
	_____________________________________________________________________________

	Student: Bofelo Lloyd Headbush - 13102932
	Final Year Type 4 Project: Frontier Inclusive Worldwide Money Transfers
	BBK 2018
	_____________________________________________________________________________
*/

    session_start();

/*
	Import Configuration Data
	-----------------------------------------------------------------------------
*/

// Include the application configuration settings
require_once dirname(__FILE__).'/includes/config.inc.php';
// Include Database connection and verification 
require_once $config['app_dir'].'/includes/connect.inc.php';
// Include Template data 
require_once $config['app_dir'].'/includes/templates.inc.php';
// Include the application general functions
require_once $config['app_dir'].'/includes/functions.inc.php';

require_once $config['app_dir'].'/templates/header.html';

/*
	Page Output and Rending
	-----------------------------------------------------------------------------
*/
// Single point of entry to decide which page will be displayed.
if (!isset($_GET['page'])) {
    $id = 'home'; 
} else {
    $id = $_GET['page'];
}
switch ($id) {
    case 'home' :
        include 'views/home.php';
        break;
    case 'dashboard' :
        include 'views/dashboard.php';
        break;
    case 'sign_up' :
        include 'views/sign_up.php';
        break;
    case 'login' :
        include 'views/login.php';
        break;
}

// Output to HTML
echo $output;

// Include Footer
require_once $config['app_dir'].'/templates/footer.html';

?>