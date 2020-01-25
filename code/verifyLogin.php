<?php
if(!empty($_POST['username']) && !empty($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        include_once '../code/Utilities.php';
        $utilities = new Utilities();
        $encryptedPassword = $utilities->encrypt($password);
//        echo $encryptedPassword;exit;
        $query = "SELECT txt_name, txt_email, txt_number, ysn_user_type FROM tbl_login WHERE "
                . " txt_email=\"$username\" AND txt_password=\"$encryptedPassword\" AND ysn_deleted = 0 AND ysn_active = 1";
        if(is_numeric($username) && strlen($username) == 10){
            $query = "SELECT txt_name, txt_email, txt_number, ysn_user_type FROM tbl_login WHERE "
                    . " txt_number=\"$username\" AND txt_password=\"$encryptedPassword\" AND ysn_deleted = 0 AND ysn_active = 1";
        }
//        echo $query;exit;
        
        $mysql = $utilities->getConn();
        if($result = $mysql->query($query)){
            if($result->num_rows > 0){
                if($rows = $result->fetch_array()){
                    session_start();
                    $_SESSION['name'] = $rows['txt_name'];
                    $_SESSION['number'] = $rows['txt_number'];
                    $_SESSION['email'] = $rows['txt_email'];
                    $_SESSION['user_type'] = $rows['ysn_user_type'];
                    if($rows['ysn_user_type'] == 1){
                        //  Go to admin dashboard
                        echo "<script>window.location.href='../admin/index.php';</script>";
                    } else if($rows['ysn_user_type'] == 2){
                        //  Go to user dashboard
                        echo "<script>window.location.href='../user/index.php';</script>";
                    }
                } else {
                    //  Something went wrong
                    echo "<script>window.location.href='../login.php?q=2';</script>";
                }
            } else {
                //  Enter correct credentials
                echo "<script>window.location.href='../login.php?q=3';</script>";
            }
        } else {
            //  Something went wrong
            echo "<script>window.location.href='../login.php?q=2';</script>";
        }
    } else {
        //  Enter correct credentials
        echo "<script>window.location.href='../login.php?q=3';</script>";
    }