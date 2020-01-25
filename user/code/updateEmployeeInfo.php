<?php
    /*
     * update Customer Detail
     */
//    echo '<pre>';print_r($_POST);exit;
if(!empty($arrPost = $_POST)){
    $q = 'error';
    if( !empty($name = $arrPost['name']) && 
        !empty($email = $arrPost['email']) && 
        !empty($number = $arrPost['number']) && 
        !empty($city = $arrPost['city']) && 
        !empty($state = $arrPost['state']) && 
        !empty($address = $arrPost['address']) && 
        !empty($registrationId = $arrPost['registrationId'])){
            include_once '../../code/Utilities.php';
            $utilities = new Utilities();
            $RegDataForNumber = "SELECT int_registration_id FROM tbl_registration WHERE txt_number = \"$number\" AND "
                    . "int_registration_id != $registrationId";
            $RegDataForEmail = "SELECT int_registration_id FROM tbl_registration WHERE txt_email = \"$email\" AND "
                    . "int_registration_id != $registrationId ";
            $LogDataForNumber = "SELECT int_login_id FROM tbl_login WHERE txt_number = \"$number\" AND "
                    . "int_registration_id != $registrationId";
            $LogDataForEmail = "SELECT int_login_id FROM tbl_login WHERE txt_email = \"$email\" AND "
                    . "int_registration_id != $registrationId ";
            if($resEmail = $utilities->selectQuery($RegDataForEmail) || 
                    $logEmail = $utilities->selectQuery($LogDataForEmail)){
                if($resEmail || $logEmail){
                    echo "<script>window.location.href='../u-my-account.php?q=emailExists';</script>";
                    exit;
                }
            }
            if($resNumber = $utilities->selectQuery($RegDataForNumber) || 
                    $resNumber = $utilities->selectQuery($LogDataForNumber)){
                if($resNumber || $resNumber){
                    echo "<script>window.location.href='../u-my-account.php?q=numberExists';</script>";
                    exit;
                }
            }
        $occupation = (!empty($arrPost['occupation']) ? $arrPost['occupation'] : '');
        session_start();
        $modifiedBy = (!empty($_SESSION['name'])? $_SESSION['name'] : ' ');
        // getting today date
        $dateModified = date('Y-m-d', strtotime('now'));
        $registerationQuery = "UPDATE tbl_registration SET "
                . "txt_name=\"$name\", "
                . "txt_number=\"$number\", "
                . "txt_email='$email', "
                . "txt_city=\"$city\", "
                . "txt_state='$state', "
                . "txt_address=\"$address\", "
                . "txt_occupation='$occupation', "
                . "dat_modified=\"$dateModified\", "
                . "txt_modified_by='$modifiedBy', "
                . "ysn_approved=1 "
                . "WHERE int_registration_id=$registrationId";
        $loginQuery = "UPDATE tbl_login SET "
                . "txt_name=\"$name\", "
                . "txt_number=\"$number\", "
                . "txt_email='$email', "
                . "dat_modified=\"$dateModified\", "
                . "txt_modified_by='$modifiedBy', "
                . "ysn_approved=1 "
                . "WHERE int_registration_id=$registrationId";
        
//            echo '<pre>';print_r($registerationQuery);exit;
        if($utilities->executeQuery($registerationQuery) && $utilities->executeQuery($loginQuery)){
            session_start();
            $_SESSION['name'] = $name;
            $_SESSION['number'] = $number;
            $_SESSION['email'] = $email;
            $q = 'saved';
        }
    }
//    echo '<pre>';print_r($q);exit;
    echo "<script>window.location.href='../u-my-account.php?q=".$q."';</script>";
}