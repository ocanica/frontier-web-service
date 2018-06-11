<?php
/*
	MySQL Database connection and verification
	-------------------------------------------------------------------------------
*/

// Database connection 
$link = mysqli_connect(
		$config['db_host'],
		$config['db_user'],
		$config['db_pass'],
		$config['db_name']
);
// Check if connection is successful
if (mysqli_connect_errno()) {
    exit('MySQL query failure. Please try again later.');
}
?>
