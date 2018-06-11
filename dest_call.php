<?php
    session_start();

    require_once dirname(__FILE__).'/includes/config.inc.php';
    require_once $config['app_dir'].'/includes/connect.inc.php';

    if (mysqli_connect_errno()) {
        $err = "This service is currently unavailable. Please try again later.";
        die($err);
    }

    $sql = "SELECT acc_uid FROM accounts WHERE acc_uid !='Frontier' AND acc_uid !='".$_SESSION['uid']."';";
    $result = mysqli_query($link, $sql);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;       
        }
    }
    echo json_encode($data);
?>