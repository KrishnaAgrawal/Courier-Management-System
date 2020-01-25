<?php
    /*
     * update Customer Detail
     */
//    echo '<pre>';print_r($_POST);exit;
if(!empty($arrPost = $_POST)){
    $q = '';
    if( !empty($arrPost['currentPasssword']) && 
        !empty($arrPost['newPasssword1']) && 
        !empty($arrPost['newPasssword2'])){
        $currentPasssword = $arrPost['currentPasssword'];
        $newPasssword1 = $arrPost['newPasssword1'];
        $newPasssword2 = $arrPost['newPasssword2'];
        if($newPasssword1 == $newPasssword2){
            include_once '../../code/Utilities.php';
            $utilities = new Utilities();
            session_start();
    //        echo '<pre>';print_r($_SESSION);exit;
            $name = $modifiedBy = (!empty($_SESSION['name'])? $_SESSION['name'] : ' ');
            $email = (!empty($_SESSION['email'])? $_SESSION['email'] : ' ');
            $number = (!empty($_SESSION['number'])? $_SESSION['number'] : ' ');
            $userType = (!empty($_SESSION['user_type'])? $_SESSION['user_type'] : ' ');
            $newPasssword1 = $utilities->encrypt($newPasssword1);
            $currentPasssword = $utilities->encrypt($currentPasssword);
            $query = "SELECT int_login_id FROM tbl_login WHERE "
                    . "txt_name=\"$name\" AND "
                    . "txt_email=\"$email\" AND "
                    . "txt_number=\"$number\" AND "
                    . "txt_password=\"$currentPasssword\" AND "
                    . "ysn_user_type=\"$userType\" ";
            if($result = $utilities->selectQuery($query)){
                if($result->num_rows > 0 && $rows = $result->fetch_array()){
                    $loginId = $rows['int_login_id'];
                    // getting today date
                    $dateModified = date('Y-m-d', strtotime('now'));
                    $loginQuery = "UPDATE tbl_login SET "
                            . "txt_password=\"$newPasssword1\", "
                            . "dat_modified=\"$dateModified\", "
                            . "txt_modified_by='$modifiedBy', "
                            . "ysn_approved=1 "
                            . "WHERE int_login_id=$loginId";
                    if($utilities->executeQuery($loginQuery)){
                        $q = 'saved';
                    } else {
                        $q = 'error';
                    }
                } else {
                    $q = 'wPswd';
                }
            } else {
                $q = 'wPswd';
            }
        } else {
            $q = 'noMatch';
        }
    } else {
        $q = 'error';
    }
        
//    echo '<pre>';print_r($q);exit;
    echo "<script>window.location.href='../change-password.php?q=".$q."';</script>";
}