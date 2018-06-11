<?php
// Store $error to later render to HTML
$error = '';
// $output variable to store the HTML for the page
$output = '';
// Set the title
$page_title = 'Error 404';
// Content to be render in <h1> tag
$page_heading = 'Error 404';
// Content to be render in <p> tag
$page_contents = 'hello';
//$page_contents = 'The requested page could not be found please try again later.';

// Replace the template tags with the relevant strings
$pass1 = str_replace('[+page_title+]', $page_title, $tpl_head);
$final = str_replace('[+page_heading+]', $page_heading, $pass1);
$error = str_replace('[+error_message+]', $page_contents, $tpl_error);

// Concatenate the contents of the head and body to output for rendering
$output .= $final . $error;
?>