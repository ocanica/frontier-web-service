<?php
    if(isset($_POST['quote'])) {
        require_once dirname(__FILE__).'/includes/config.inc.php';
        require_once $config['app_dir'].'/includes/connect.inc.php';

        if (mysqli_connect_errno()) {
            $err = "This service is currently unavailable. Please try again later.";
            die($err);
        }

        $amount = mysqli_real_escape_string($link, $_POST['amount_q']);
        $curr = mysqli_real_escape_string($link, $_POST['curr_q']);
        $src = mysqli_real_escape_string($link, $_POST['src_q']);
        $sql = "SELECT curr_code,(curr_rate*$amount) AS result, (SELECT acc_base_unit from accounts where acc_uid= '".$src."') AS base_unit, (SELECT ROUND((SELECT result)*(SELECT base_unit),2)) AS final, (SELECT ROUND(((SELECT final)-(SELECT result))/curr_rate,2)) AS fees, ((SELECT final)-(SELECT fees)) AS final_less_fees FROM rates where curr_name = '".$curr."';";
        //$sql = "SELECT curr_code,(curr_rate*$amount) AS result, (SELECT acc_base_unit from accounts where acc_uid= '".$src."') AS base_unit, (SELECT ROUND((SELECT result)*(SELECT base_unit),2)) AS final, (SELECT ROUND(((SELECT final)-(SELECT result))/curr_rate,2)) AS fees FROM rates where curr_name = '".$curr."';";        
        $result = mysqli_query($link, $sql);

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;       
            }
        }
        //print_r($data);
        echo json_encode($data);
    }
?>