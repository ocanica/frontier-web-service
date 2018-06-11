<?php
            
            $_SESSION['message'] ='';
            
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
                    $email = mysqli_real_escape_string($link, $_POST['email']);
                    $username = mysqli_real_escape_string($link, $_POST['username']);
                    $pwd = mysqli_real_escape_string($link, $_POST['pwd']); //pre-hashed pasword
                    $acc_type = mysqli_real_escape_string($link, $_POST['acc_type']);
                    $fName = mysqli_real_escape_string($link, $_POST['fName']);
                    $lName = mysqli_real_escape_string($link, $_POST['lName']);
                    $address = mysqli_real_escape_string($link, $_POST['address']);
                    $city = mysqli_real_escape_string($link, $_POST['city']);
                    $postcode = mysqli_real_escape_string($link, $_POST['postcode']);
                    $country = mysqli_real_escape_string($link, $_POST['country']);
                    $join_date = date('Y-m-d H:i:s');
                    $acc_base_unit = ($_POST['acc_type'] == 'Business') ? 1.015 : 1;
                    
                    if (mysqli_connect_errno()) {
                        $err = "This service is currently unavailable. Please try again later.";
                        die($err);
                    }
                                
                    $checkEmails = mysqli_query($link,"SELECT * FROM users WHERE user_email = '".$email."'");
                    $checkUsers = mysqli_query($link,"SELECT * FROM users WHERE user_uid = '".$username."'");
                    $numEmails = mysqli_num_rows($checkEmails);
                    $numUsers = mysqli_num_rows($checkUsers);

                    if($numEmails > 0 || $numUsers > 0) {
                        $_SESSION['message'] = "username and/or email already exists, please try again";
                    } else {
                    
                        try {
                            //hashing password
                            $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT);
                            
                            //pass insert query into $sql variable 
                            $sql1 = "INSERT INTO users (
                                        user_email, user_uid, user_pwd, user_fname, user_lname, user_address, user_city, user_postcode, user_country, user_join_date
                                    ) VALUES (
                                        '$email', '$username', '$hashedPwd', '$fName', '$lName', '$address', '$city', '$postcode', '$country', '$join_date'
                                    );";
                            $sql2 = "INSERT INTO accounts (
                                        acc_uid, acc_type, acc_base_unit, acc_balance
                                    ) VALUES ('$username', '$acc_type', '$acc_base_unit', 100.00);";
                            $sql3 = "INSERT INTO transactions (
                                    trans_id, trans_uid_src, trans_uid_dest, trans_amount, trans_curr_name, trans_fee, trans_sum, trans_date
                                    ) VALUES (".rand(10000, 99999).", 'system', '$username', 100.00, 'Great British Pound', 0.0, 100.00, '".date('Y-m-d H:i:s')."');";
                            $insert1 = mysqli_query($link, $sql1);
                            $insert2 = mysqli_query($link, $sql2);
                            $insert3 = mysqli_query($link, $sql3);
                            // set autocommit to off
                            mysqli_autocommit($link, FALSE);
                            mysqli_query($link, 'START TRANSACTION');
                            
                            //Run queries, checking for errors
                            if(($insert1 && $insert2) &&($insert3)) {
                                //Commit the transaction
                                mysqli_commit($link);
                                
                                $row = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM users WHERE user_uid = '".$username."'"));
                                //user session determined on successfull sign up
                                $_SESSION['uid'] = $row['user_uid'];
                                
                                header("Location: index.php?page=dashboard&" . $username);
                                exit();
                            } else {
                                //roll back changes to the table if any errors occur
                                mysqli_rollback($link);
                            }
                            
                        } catch (Exception $e) {
                            $_SESSION['message'] = 'Caught exception: '. $e->getMessage(). "/n";
                            return false;
                        }
                        //mysqli_close($link);   
                    }
            }
?>