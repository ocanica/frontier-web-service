<?php
if(!dateCheck()) {
    $xml =  simplexml_load_file('http://www.floatrates.com/daily/gbp.xml');
    if($xml === false) {
        die("Error: Unable to create XML object");
    } else {
        if (mysqli_connect_errno()) {
            $err = "This service is currently unavailable. Please try again later.";
            die($err);
        }
            
        $sql = "SELECT * FROM rates";
        $result = mysqli_query($link, $sql);
        
        if(mysqli_num_rows($result)==0) {
            $link->autocommit(FALSE);
            $sql = "INSERT INTO rates (
                            curr_code, curr_name, curr_rate, curr_pub_date, prev_curr_rate
                            ) VALUES (
                            ?,?,?,?,?
                            );";
            if($stmt = $link->prepare($sql)) {
                foreach($xml->item as $item) {
                    $curr_code = $item->targetCurrency;
                    $curr_name = $item->targetName;
                    $raw_curr_rate = $item->exchangeRate;
                    $curr_comma_remove = str_replace( ',', '', $raw_curr_rate); 
                    $fconv_curr_rate = (float)$curr_comma_remove;
                    $curr_rate = bcdiv($fconv_curr_rate, 1, 3);
                    $curr_pub_date = date("Y-m-d");
                    $prev_curr_rate = 1;
                          
                    mysqli_stmt_bind_param($stmt, "ssdsd", $curr_code, $curr_name, $curr_rate, $curr_pub_date, $prev_curr_rate);
                    $stmt->execute();
                }
                $stmt->close();
                $link->commit();
            }
        } else {
            $query = "UPDATE rates SET prev_curr_rate = curr_rate";
            mysqli_query($link,$query);
            
            $link->autocommit(FALSE);
            $sql = "UPDATE rates 
                    SET curr_rate=?, curr_pub_date=?
                    WHERE curr_code=?";
            if($stmt = $link->prepare($sql)) {
                foreach($xml->item as $item) {
                    $curr_code = $item->targetCurrency;
                    $raw_curr_rate = $item->exchangeRate;
                    $curr_comma_remove = str_replace( ',', '', $raw_curr_rate); 
                    $fconv_curr_rate = (float)$curr_comma_remove;
                    $curr_rate = bcdiv($fconv_curr_rate, 1, 3);
                    $curr_pub_date = date("Y-m-d");
                          
                    mysqli_stmt_bind_param($stmt, "dss", $curr_rate, $curr_pub_date, $curr_code);
                    $stmt->execute();
                }
            $stmt->close();
            $link->commit();
            }
        }
    }
}
?>