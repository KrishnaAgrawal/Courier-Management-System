<?php
    if(!empty($_GET)){
        $query  = '';
        $arrPost = [];
        if(!empty($_GET['action'])){
            $query = $_GET['action'];
        }
        if(!empty($_POST)){
            $arrPost = $_POST;
        }
//        echo '<pre>';print_r($arrPost);exit;
        switch ($query){
            case "getHits": getHits($arrPost);
            break;
            case "getUsers": getUsers($arrPost);
            break;
            case "updateCustomerDetail": updateCustomerDetail($arrPost);
            break; 
            case "deleteCustomerDetail": deleteCustomerDetail($arrPost);
            break; 
        
        }
    }
    
    /*
     * get Hits from ajax
     */
    function getHits($arrPost) {
        $endDate = [];
        $startDate = [];
        $hits = 0;
        $boolTemp = FALSE;
        if(!empty($arrPost['startDateHits'])){
            $startDate = $arrPost['startDateHits'];
        }
        if(!empty($arrPost['endDateHits'])){
            $endDate = $arrPost['endDateHits'];
        }
        if(empty($startDate) && !empty($endDate)){
            $query = "SELECT IFNULL(SUM(hits), 0) as hits"
                    . " FROM user_hits WHERE date <= \"$endDate\"";
            $boolTemp = TRUE;
        } else if(empty($endDate) && !empty($startDate)){
            $query = "SELECT IFNULL(SUM(hits), 0) as hits"
                    . " FROM user_hits WHERE date >= \"$startDate\"";
            $boolTemp = TRUE;
        } else if(!empty($endDate) && !empty($startDate)){
            $query = "SELECT COUNT(ip_address) as users, IFNULL(SUM(hits), 0) as hits "
                    . "FROM user_hits WHERE date BETWEEN \"$startDate\" AND \"$endDate\"";
            $boolTemp = TRUE;
        }
        if($boolTemp){
            include_once '../code/Utilities.php';
            $utilities = new Utilities();
            $mysql = $utilities->getConn();
            if($result = $mysql->query($query)){
                if($result->num_rows > 0){
                    if($rows = $result->fetch_array()){
                        echo $hits = $rows['hits'];
                    }
                }
            }
        } else {
            echo "Select atleast one date";
        }
    }
    
    /*
     * get Users from ajax
     */
    function getUsers($arrPost) {
        $endDate = [];
        $startDate = [];
        $users = 0;
        $boolTemp = FALSE;
        if(!empty($arrPost['startDateUsers'])){
            $startDate = $arrPost['startDateUsers'];
        }
        if(!empty($arrPost['endDateUsers'])){
            $endDate = $arrPost['endDateUsers'];
        }
        if(empty($startDate) && !empty($endDate)){
            $query = "SELECT COUNT(ip_address) as users "
                    . " FROM user_hits WHERE date <= \"$endDate\"";
            $boolTemp = TRUE;
        } else if(empty($endDate) && !empty($startDate)){
            $query = "SELECT COUNT(ip_address) as users "
                    . " FROM user_hits WHERE date >= \"$startDate\"";
            $boolTemp = TRUE;
        } else if(!empty($endDate) && !empty($startDate)){
            $query = "SELECT COUNT(ip_address) as users "
                    . "FROM user_hits WHERE date BETWEEN \"$startDate\" AND \"$endDate\"";
            $boolTemp = TRUE;
        }
        if($boolTemp){
            include_once '../code//Utilities.php';
            $utilities = new Utilities();
            $mysql = $utilities->getConn();
            if($result = $mysql->query($query)){
                if($result->num_rows > 0){
                    if($rows = $result->fetch_array()){
                        echo $users = $rows['users'];
                    }
                }
            }
        } else {
            echo "Select atleast one date";
        }
    }

    /*
     * update Customer Detail
     */
    function updateCustomerDetail($arrPost) {
        if( !empty($arrPost['custId']) && 
            !empty($arrPost['customerName']) && 
            !empty($arrPost['customerNumber'])){
            $custId = $arrPost['custId'];
            $customerName = $arrPost['customerName'];
            $customerNumber = $arrPost['customerNumber'];
            $customerEmail = (!empty($arrPost['customerEmail'])? $arrPost['customerEmail'] : '');
            $customerAddress = (!empty($arrPost['customerAddress'])? $arrPost['customerAddress'] : '');
            $customerCity = (!empty($arrPost['customerCity'])? $arrPost['customerCity'] : '');
            $customerState = (!empty($arrPost['customerState'])? $arrPost['customerState'] : '');
            session_start();
            $modifiedBy = (!empty($_SESSION['name'])? $_SESSION['name'] : ' ');
            // getting today date
            $dateModified = date('Y-m-d', strtotime('now'));
            $query = "UPDATE tbl_registration SET "
                    . "txt_name=\"$customerName\", "
                    . "txt_number=\"$customerNumber\", "
                    . "txt_email='$customerEmail', "
                    . "txt_address='$customerAddress', "
                    . "txt_city='$customerCity', "
                    . "txt_state='$customerState', "
                    . "dat_modified=\"$dateModified\", "
                    . "txt_modified_by='$modifiedBy', "
                    . "ysn_approved=1 "
                    . "WHERE int_registration_id=$custId";
            $loginQuery = "UPDATE tbl_login SET "
                    . "txt_name=\"$customerName\", "
                    . "txt_number=\"$customerNumber\", "
                    . "txt_email='$customerEmail', "
                    . "dat_modified=\"$dateModified\", "
                    . "txt_modified_by='$modifiedBy', "
                    . "ysn_approved=1 "
                    . "WHERE int_registration_id=$custId";
            include_once '../code/Utilities.php';
            $utilities = new Utilities();
//            echo '<pre>';print_r($query);exit;
            if($utilities->executeQuery($query) && $utilities->executeQuery($loginQuery)){
                echo "SUCCESS";
            } else {
                echo "ERROR";
            }
        }
    }
    
    /*
     * delete Product Group Detail
     */
    function deleteCustomerDetail($arrPost) {
        if(!empty($arrPost['customerId'])){
            $customerId = $arrPost['customerId'];
            $query = "UPDATE customer_info SET ysn_deleted=1 "
                    . "WHERE cust_id=$customerId";
            include_once './code/Utilities.php';
            $utilities = new Utilities();
            $mysql = $utilities->getConn();
//            echo '<pre>';print_r($query);exit;
            if($mysql->query($query)){
                echo "SUCCESS";
            } else {
                echo "ERROR";
            }
        }
    }
    