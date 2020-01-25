<?php

    if($arrPost = $_POST){
        session_start();
        $strCaptcha = '';
        if(!empty($_SESSION['captcha_code'])){
            $strCaptcha = $_SESSION['captcha_code'];
        }
        if($strCaptcha == (!empty($arrPost['captcha'] ? $arrPost['captcha'] : ''))){
            $password1 = $arrPost['password1'];
            $password2 = $arrPost['password2'];
            if($password1 == $password2){
                $name = $arrPost['name'];
                $email = $arrPost['email'];
                $number = $arrPost['number'];
                $occupation = $arrPost['occupation'];
                $city = $arrPost['city'];
                $state = $arrPost['state'];
                $address = $arrPost['address'];
                include_once '../code/Utilities.php';
                $utilities = new Utilities();
                $RegDataForNumber = "SELECT int_registration_id FROM tbl_registration WHERE txt_number = \"$number\"";
                $RegDataForEmail = "SELECT int_registration_id FROM tbl_registration WHERE txt_email = \"$email\" ";
                $LogDataForNumber = "SELECT int_login_id FROM tbl_login WHERE txt_number = \"$number\"";
                $LogDataForEmail = "SELECT int_login_id FROM tbl_login WHERE txt_email = \"$email\" ";
                if($resEmail = $utilities->selectQuery($RegDataForEmail) || 
                        $logEmail = $utilities->selectQuery($LogDataForEmail)){
                    if($resEmail || $logEmail){
                        echo "<script>window.location.href='../register.php?q=emailExists';</script>";
                        exit;
                    }
                }
                if($resNumber = $utilities->selectQuery($RegDataForNumber) || 
                        $resNumber = $utilities->selectQuery($LogDataForNumber)){
                    if($resNumber || $resNumber){
                        echo "<script>window.location.href='../register.php?q=numberExists';</script>";
                        exit;
                    }
                }
                $getMaxRegId = "SELECT max(int_registration_id) as int_registration_id FROM tbl_registration";
                $resultMaxRegId = '';
                if($resultMaxRegId = $utilities->selectQuery($getMaxRegId)){
                    if($rows = $resultMaxRegId->fetch_array()){
                        $resultMaxRegId = $rows['int_registration_id']+1;
                    }
                }
                $getMaxLoginId = "SELECT max(int_login_id) as int_login_id FROM tbl_login";
                $resultMaxLogId = '';
                if($resultMaxLogId = $utilities->selectQuery($getMaxLoginId)){
                    if($rows = $resultMaxLogId->fetch_array()){
                        $resultMaxLogId = $rows['int_login_id']+1;
                    }
                }
                $encryptedPassword = $utilities->encrypt($password1);
                $dateCreated = date("Y-m-d", strtotime('now'));
                $createdBy = $name;
                $registerSql = "INSERT INTO tbl_registration (int_registration_id, txt_name, txt_email, txt_number, txt_city, "
                        . "txt_state, txt_address, txt_occupation, txt_password, "
                        . "dat_created, txt_created_by) VALUES ("
                        . "'$resultMaxRegId', '$name', '$email', '$number', '$city', '$state', '$address', '$occupation', '$encryptedPassword', "
                        . "'$dateCreated', '$createdBy')";
                $loginSql = "INSERT INTO tbl_login (int_login_id, int_registration_id, txt_name, txt_email, txt_number, "
                        . "txt_password, dat_created, txt_created_by) VALUES ("
                        . "'$resultMaxLogId', '$resultMaxRegId', '$name', '$email', '$number', '$encryptedPassword', "
                        . "'$dateCreated', '$createdBy')";
                if($utilities->executeQuery($registerSql) && $utilities->executeQuery($loginSql)){
                    echo "<script>window.location.href='../register.php?q=saved';</script>";
                } else {
                    echo "<script>window.location.href='../register.php?q=err';</script>";
                }
            } else {
                echo "<script>window.location.href='../register.php?q=nopswdmtch';</script>";
            }
        } else {
            echo "<script>window.location.href='../register.php?q=invalidCaptcha';</script>";
        }
    }
