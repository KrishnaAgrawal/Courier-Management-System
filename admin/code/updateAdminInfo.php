<?php
    /*
     * update Customer Detail
     */
//    echo '<pre>';print_r($_POST);exit;
if(!empty($arrPost = $_POST)){
    $q = '';
    if( !empty($arrPost['name']) && 
        !empty($arrPost['email']) && 
        !empty($arrPost['number']) && 
        !empty($arrPost['loginId'])){
        $name = $arrPost['name'];
        $number = $arrPost['number'];
        $email = $arrPost['email'];
        $loginId = $arrPost['loginId'];
        session_start();
        $modifiedBy = (!empty($_SESSION['name'])? $_SESSION['name'] : ' ');
        // getting today date
        $dateModified = date('Y-m-d', strtotime('now'));
        $loginQuery = "UPDATE tbl_login SET "
                . "txt_name=\"$name\", "
//                . "txt_number=\"$number\", "
//                . "txt_email='$email', "
                . "dat_modified=\"$dateModified\", "
                . "txt_modified_by='$modifiedBy', "
                . "ysn_approved=1 "
                . "WHERE int_login_id=$loginId";
        include_once '../../code/Utilities.php';
        $utilities = new Utilities();
//            echo '<pre>';print_r($query);exit;
        if($utilities->executeQuery($loginQuery)){
            session_start();
            $_SESSION['name'] = $name;
            $q = 'saved';
        } else {
            $q = 'error';
        }
    } else {
        $q = 'error';
    }
//    echo '<pre>';print_r($q);exit;
    echo "<script>window.location.href='../my-account.php?q=".$q."';</script>";
}