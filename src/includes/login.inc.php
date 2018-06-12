<?php
       $_SESSION['message'] ='';
       
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
                    $username = mysqli_real_escape_string($link, $_POST['username']);
                    $pwd = mysqli_real_escape_string($link, $_POST['pwd']); //pre-hashed pasword
                    
                    if (mysqli_connect_errno()) {
                        $err = "This service is currently unavailable. Please try again later.";
                        die($err);
                    }
                    
                    $checkUsers = mysqli_query($link, "SELECT * FROM users WHERE user_uid = '".$username."'");
                    $numUsers = mysqli_num_rows($checkUsers);
                    
                    if($numUsers < 1) {
                        $_SESSION['message'] = "username and/or email not found, please try again";
                    } else {
                        if($row = mysqli_fetch_assoc($checkUsers)) {
                            //de-hashing password
                            $pwdCheck = password_verify($pwd, $row['user_pwd']);
                            //check for passwaord match
                            if($pwdCheck == false) {
                                $_SESSION['message'] = "username and/or email not found, please try again";
                            } elseif($pwdCheck == true) {
                                //esleif vital for security -- log in user
                                //$_SESSION['email'] = $row['user_email'];
                                $_SESSION['uid'] = $row['user_uid'];/*
                                $_SESSION['fname'] = $row['user_fname'];
                                $_SESSION['lname'] = $row['user_lname'];
                                $_SESSION['address'] = $row['user_address'];
                                $_SESSION['city'] = $row['user_city'];
                                $_SESSION['postcode'] = $row['user_postcode'];
                                $_SESSION['country'] = $row['user_country'];
                                $_SESSION['acc_type'] = $row['user_acc_type'];*/
                                
                                header("Location: index.php?page=dashboard&" . $username);
                                exit();
                            }
                        }
                    }

                //mysqli_close($link);
            }
?>       