<?php
    if(isset($_POST['search'])) {
        require_once dirname(__FILE__).'/includes/config.inc.php';
        require_once $config['app_dir'].'/includes/connect.inc.php';

        if (mysqli_connect_errno()) {
            $err = "This service is currently unavailable. Please try again later.";
            die($err);
        }

        $query = mysqli_real_escape_string($link, $_POST['q']);

        $sql = "SELECT curr_name FROM rates WHERE (curr_name LIKE '%$query%') OR (curr_code LIKE '%$query%')";
        $result = mysqli_query($link, $sql);

        if(mysqli_num_rows($result) > 0) {
            $response = "<ul>";
            while($row = mysqli_fetch_assoc($result)) {
                $response .= "<li>".$row['curr_name']."</li>";
            }
            $response .= "</ul>";
            $row = mysqli_fetch_assoc($result);
            
        } else {
            $response = '<ul> currency not found </ul>';
        }
        exit($response);
    }
?>