<?php
/*
	Main function necessary to build the database as well as draw the elements in HTML
	---------------------------------------------------------------------------------------------
*/
//pull and render gbp rates table
/*
function rates_table() {
    $xml =  simplexml_load_file('http://www.floatrates.com/daily/gbp.xml');
    if($xml === false) {
        die("Error: Unable to create XML object");
    }
    $render_table = '<table width="100%" cellspacing="1"><tr>';
        foreach($xml->item as $item) {
            $render_table .= '<tr>';
            $render_table .= '<td class="d5">' . $item->targetName . '</td><td class="d5">' . $item->targetCurrency . '</td><td class="d5">' . $item->exchangeRate . '</td>';
            $render_table .= '</tr>';
        }
    $render_table .="</table>";
    return $render_table;
}*/

function rates_table() {
    global $link;
    $sql = "SELECT * FROM rates ORDER BY curr_name";
    
    if (mysqli_connect_errno()) {
        $err = "This service is currently unavailable. Please try again later.";
        die($err);
    }
                    
    $result = mysqli_query($link, $sql);
    $rates = array();
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $rates[] = $row;       
        }
    }
    
    $render_table  = '<table role="table" aria-label="Rates"><tr>';
    foreach($rates as $rate) {
        $render_table .= '<tr>';
        $render_table .= '<td class="d5">' . $rate['curr_name'] . '</td><td class="d5">' . $rate['curr_code'] . '</td><td class="d5">' . $rate['curr_rate'] . '</td>';
        $render_table .= '</tr>';
    }
    $render_table .="</table>";
    //mysqli_close($link);
    return $render_table;
}

function dateCheck() {
    global $link;
    $flag = false;
    if (mysqli_connect_errno()) {
        $err = "This service is currently unavailable. Please try again later.";
        die($err);
    }
    
    $sql = "SELECT curr_pub_date FROM rates WHERE curr_code = 'EUR'";
    $result = mysqli_query($link, $sql);
    
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        foreach($row as $val => $check) {
            if($check == date("Y-m-d")) $flag = true;
        }
    } 
    return $flag;
}

function call_user_elements() {
    global $link;
    
    if (mysqli_connect_errno()) {
        $err = "This service is currently unavailable. Please try again later.";
        die($err);
    }
    //emulate outer join
    $sql = "SELECT *
    FROM users, accounts
    WHERE users.user_uid = '".$_SESSION['uid']."'
    AND accounts.acc_uid='".$_SESSION['uid']."';";
    $row = mysqli_fetch_assoc(mysqli_query($link, $sql));
                        
    $_SESSION['email'] = $row['user_email'];
    $_SESSION['fname'] = $row['user_fname'];
    $_SESSION['lname'] = $row['user_lname'];
    $_SESSION['address'] = $row['user_address'];
    $_SESSION['city'] = $row['user_city'];
    $_SESSION['postcode'] = $row['user_postcode'];
    $_SESSION['country'] = $row['user_country'];
    $_SESSION['acc_type'] = $row['acc_type'];
    $_SESSION['balance'] = $row['acc_balance'];
}

function call_head_curr_elements() {
    global $link;
    $rate = array();
    
    if (mysqli_connect_errno()) {
        $err = "This service is currently unavailable. Please try again later.";
        die($err);
    }
    $sql = "SELECT curr_rate, prev_curr_rate FROM rates 
            WHERE curr_code 
            IN ('EUR','INR','MUR','PHP','HRK','ZAR')
            ORDER BY FIELD(curr_code,'EUR','INR','MUR','PHP','HRK','ZAR');";
    $result = mysqli_query($link, $sql);
    
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $rate[] = $row;       
        }
        $_SESSION['eur'] = $rate[0]['curr_rate'] . curr_eval($rate[0]['curr_rate'], $rate[0]['prev_curr_rate']);
        $_SESSION['inr'] = $rate[1]['curr_rate'] . curr_eval($rate[1]['curr_rate'], $rate[1]['prev_curr_rate']);
        $_SESSION['mur'] = $rate[2]['curr_rate'] . curr_eval($rate[2]['curr_rate'], $rate[2]['prev_curr_rate']);
        $_SESSION['php'] = $rate[3]['curr_rate'] . curr_eval($rate[3]['curr_rate'], $rate[3]['prev_curr_rate']);
        $_SESSION['hrk'] = $rate[4]['curr_rate'] . curr_eval($rate[4]['curr_rate'], $rate[4]['prev_curr_rate']);
        $_SESSION['zar'] = $rate[5]['curr_rate'] . curr_eval($rate[5]['curr_rate'], $rate[5]['prev_curr_rate']);
    }
}

function curr_eval($rate1, $rate2) {
    $arrow = '';
    if($rate1 < $rate2) {
        $arrow = '<div class="colour_red">&#9660</div>';
    } elseif($rate1 > $rate2) {
        $arrow = '<div class="colour_green">&#9650</div>';
    } elseif($rate1 == $rate2) {
        $arrow = '<div class="colour_blue">&#9644</div>';
    }    
    return $arrow;
}














?>