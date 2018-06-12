<?php
session_start();
require_once dirname(__FILE__).'/includes/config.inc.php';
require_once $config['app_dir'].'/includes/connect.inc.php';

$uid_balance = mysqli_fetch_assoc(mysqli_query($link, "SELECT acc_balance FROM accounts WHERE acc_uid = '".$_SESSION['uid']."'"));
$src_uid_balance = mysqli_fetch_assoc(mysqli_query($link, "SELECT acc_balance FROM accounts WHERE acc_uid = '".$_SESSION['uid']."'"));

if(isset($_REQUEST)) {
    if (mysqli_connect_errno()) {
        $err = "This service is currently unavailable. Please try again later.";
        die($err);
    }

    if(isset($_POST['deposit']))    {
        $_SESSION['message'] = '';
        $deposit = mysqli_real_escape_string($link, $_POST['deposit']);

        if(($uid_balance['acc_balance'] + $deposit ) <= 9999.99) {
            $sql1 = "UPDATE accounts SET acc_balance = acc_balance + $deposit WHERE acc_uid = '".$_SESSION['uid']."';";
            $sql2 = "INSERT INTO transactions (
                trans_id, trans_uid_src, trans_uid_dest, trans_amount, trans_curr_name, trans_fee, trans_sum, trans_date
                ) VALUES (".rand(10000, 99999).", 'system', '".$_SESSION['uid']."', $deposit, 'Great British Pound', 0.0, $deposit, '".date('Y-m-d H:i:s')."');";
            
            $insert1 = mysqli_query($link, $sql1);
            $insert2 = mysqli_query($link, $sql2);
    
            if($insert1 && $insert2) {
                //Commit the transaction
                mysqli_commit($link);
            } else {
                //roll back changes to the table if any errors occur
                mysqli_rollback($link);
            } 
        } else {
            $_SESSION['message'] = 'Exceeded £9,999.99 limit';
        }
    }

    if(isset($_POST['withdraw']))    {
        $_SESSION['message'] = '';
        $withdraw = mysqli_real_escape_string($link, $_POST['withdraw']);

        if(($uid_balance['acc_balance'] - $withdraw ) > 0) {
            $sql1 = "UPDATE accounts SET acc_balance = acc_balance - $withdraw WHERE acc_uid = '".$_SESSION['uid']."';";
            $sql2 = "INSERT INTO transactions (
                trans_id, trans_uid_src, trans_uid_dest, trans_amount, trans_curr_name, trans_fee, trans_sum, trans_date
                ) VALUES (".rand(10000, 99999).", '".$_SESSION['uid']."','system', -$withdraw, 'Great British Pound', 0.0, -$withdraw, '".date('Y-m-d H:i:s')."');";
            
            $insert1 = mysqli_query($link, $sql1);
            $insert2 = mysqli_query($link, $sql2);
    
            if($insert1 && $insert2) {
                //Commit the transaction
                mysqli_commit($link);
            } else {
                //roll back changes to the table if any errors occur
                mysqli_rollback($link);
            } 
        } else {
            $_SESSION['message'] = 'Insufficient funds';
        }
    }

    echo $uid_balance['acc_balance'];
    
}

if(isset($_POST['quote'])) {
    if (mysqli_connect_errno()) {
        $err = "This service is currently unavailable. Please try again later.";
        die($err);
    }

    $amount = mysqli_real_escape_string($link, $_POST['amount_q']);
    $curr = mysqli_real_escape_string($link, $_POST['curr_q']);
    $src = mysqli_real_escape_string($link, $_POST['src_q']);
    $dest = mysqli_real_escape_string($link, $_POST['dest_q']);
    $trans_id = rand(10000, 99999);

    if(($uid_balance['acc_balance'] - $amount) > 0) {
        $sql1 = "UPDATE accounts 
                    SET acc_balance = CASE acc_uid
                        WHEN '".$_SESSION['uid']."' THEN acc_balance - $amount
                        WHEN '".$src."' THEN acc_balance - ($amount-($amount/1.015))
                        WHEN '".$dest."' THEN acc_balance + ($amount/1.015)
                    END
                WHERE acc_uid in ('".$_SESSION['uid']."', '".$src."', '".$dest."');";
        $sql2 = "INSERT INTO transactions (
            trans_id, trans_uid_src, trans_uid_dest, trans_amount, trans_curr_name, trans_fee, trans_sum, trans_date
            ) VALUES (".$trans_id.", '".$_SESSION['uid']."', '".$dest."', - ($amount/1.015), '".$curr."', 0.0, -$amount, '".date('Y-m-d H:i:s')."');";
        $sql3 = "INSERT INTO transactions (
            trans_id, trans_uid_src, trans_uid_dest, trans_amount, trans_curr_name, trans_fee, trans_sum, trans_date
            ) VALUES (".$trans_id.", '".$src."', '".$dest."', - ($amount-($amount/1.015)), '".$curr."', 0.0, -$amount, '".date('Y-m-d H:i:s')."');";

        $insert1 = mysqli_query($link, $sql1);
        $insert2 = mysqli_query($link, $sql2);
        $insert3 = mysqli_query($link, $sql3);

        if(($insert1 && $insert2) && $insert3) {
            //Commit the transaction
            mysqli_commit($link);
        } else {
            //roll back changes to the table if any errors occur
            mysqli_rollback($link);
        } 

    } else {
        $_SESSION['message'] = 'Insufficient funds';
    }

    echo $uid_balance['acc_balance'];
}
?>