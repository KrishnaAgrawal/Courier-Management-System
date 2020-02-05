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
            case "get-booked-courier-data" : getBookedCourierData($arrPost);
                break;
            case "updateCourierPackage" : updateCourierPackage($arrPost);
                break;
            case "delete-booked-courier-data" : deleteCourierPackage($_GET);
                break;
            case "get-feedback" : getFeedback($arrPost);
                break;
            case "updateFeedback" : updateFeedback($arrPost);
                break;
            case "deleteFeedback" : deleteFeedback($_GET);
                break;
            case "get-complaint" : getComplaint($arrPost);
                break;
            case "updateComplaint" : updateComplaint($arrPost);
                break;
            case "deleteComplaint" : deleteComplaint($_GET);
                break;
            case "get-review" : getReview($arrPost);
                break;
            case "updateReview" : updateReview($arrPost);
                break;
            case "deleteReview" : deleteReview($_GET);
                break;
            case "updateApproveStatus": updateApproveStatus($arrPost);
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
            include_once '../../code/Utilities.php';
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
            include_once '../../code//Utilities.php';
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
            include_once '../../code/Utilities.php';
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
            $query = "UPDATE tbl_registration SET ysn_deleted=1 "
                    . "WHERE int_registration_id=$customerId";
            include_once '../../code/Utilities.php';
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
    
    
/*
 * get Booked Courier Data
 */
function getBookedCourierData($arrPost){
    if(!empty($courierId = $arrPost['courierId'])){
        include_once '../../code/Utilities.php';
        $query = "SELECT int_courier_booking_id, txt_sender_name, txt_sender_mobile, txt_courier_status, "
                . "txt_sender_email, txt_sender_address_line1, txt_courier_item_content, int_courier_item_pieces, "
                . "txt_weight, txt_origin, txt_recipient_name, txt_recipient_mobile, txt_recipient_alternate_mobile, "
                . "txt_recipient_email, txt_recipient_address_line1, txt_destination, dat_booked, txt_transport_mode "
                . "FROM tbl_courier_booking WHERE int_courier_booking_id = $courierId AND ysn_deleted=0";
        $utilities = new Utilities();
        if($result = $utilities->selectQuery($query)){
            if(!empty($result)){
                while ($rows = $result->fetch_array()){
//                    echo '<pre>';print_r($rows);exit;
                    echo json_encode($rows);
                }
            }
        }
    }
}


/*
 * updateCourierPackage
 */
function updateCourierPackage($arrPost){
        $q = "error";
    if(!empty($courierBookingId = $arrPost['int_courier_booking_id']) && 
            !empty($senderName = $arrPost['txt_sender_name']) && 
            !empty($senderNumber = $arrPost['txt_sender_number']) && 
            !empty($from = $arrPost['from']) && 
            !empty($courierItem = $arrPost['txt_courier_item']) && 
            !empty($courierWeight = $arrPost['weight']) && 
            !empty($recipientName = $arrPost['txt_recipient_name']) && 
            !empty($recipientNumber = $arrPost['txt_recipient_number']) && 
            !empty($recipientAddressLine1 = $arrPost['txt_recipient_address_line1']) && 
            !empty($to = $arrPost['to']) && 
            !empty($bookingDate = $arrPost['bookingDate']) && 
            !empty($courierStatus = $arrPost['courierStatus']) && 
            !empty($serviceType = $arrPost['txt_service_type'])
        ){
            $service = '';
            $deliveryDate = '';
            $price = '';
            include_once '../../code/ajaxRequest.php';
            $arr = [
                'from' => $from,
                'to' => $to,
                'bookingDate' => $bookingDate,
                'weight' => $courierWeight,
                'directCall' => 1,
            ];
        $resultData = getTimeAndPrice($arr);
            switch ($serviceType){
                case 'Air': $service = $serviceType; 
                            $deliveryDate = $resultData['airDeliveryDate'];
                            $price = $resultData['airPrice'];
                            break;
                case 'Ground': $service = $serviceType; 
                            $deliveryDate = $resultData['groundDeliveryDate'];
                            $price = $resultData['groundPrice'];
                            break;
                case 'Document': $service = $serviceType; 
                            $deliveryDate = $resultData['documentDeliveryDate'];
                            $price = $resultData['documentPrice'];
                            break;
            }
        $deliveryDate = date('Y-m-d', strtotime($deliveryDate));
        $senderEmail = (!empty($arrPost['txt_sender_email']) ? $arrPost['txt_sender_email'] : '');
        $senderAddressLine1 = (!empty($arrPost['txt_sender_address_line1']) ? $arrPost['txt_sender_address_line1'] : '');
        $courierItemPieces = (!empty($arrPost['txt_courier_item_pieces']) ? $arrPost['txt_courier_item_pieces'] : '');
        $recipientAlternativeNumber = (!empty($arrPost['txt_recipient_alternate_number']) ? $arrPost['txt_recipient_alternate_number'] : '');
        $recipientEmail = (!empty($arrPost['txt_recipient_email']) ? $arrPost['txt_recipient_email'] : '');
        $dateModified = date('Y-m-d', strtotime('now'));
        session_start();
        $modifiedBy = (!empty($_SESSION['name']) ? $_SESSION['name'] : '');
        $query = "UPDATE tbl_courier_booking SET txt_sender_name = \"$senderName\", txt_sender_mobile = \"$senderNumber\", "
                . "txt_sender_email = \"$senderEmail\", txt_sender_address_line1 = \"$senderAddressLine1\", "
                . "txt_courier_item_content = \"$courierItem\", int_courier_item_pieces = \"$courierItemPieces\", "
                . "txt_weight = \"$courierWeight\", txt_origin = \"$from\", txt_recipient_name = \"$recipientName\", "
                . "txt_recipient_mobile = \"$recipientNumber\", txt_recipient_alternate_mobile = \"$recipientAlternativeNumber\", "
                . "txt_recipient_email = \"$recipientEmail\", txt_recipient_address_line1 = \"$recipientAddressLine1\", "
                . "txt_destination = \"$to\", dat_booked = \"$bookingDate\", txt_transport_mode = \"$service\", "
                . "txt_price = \"$price\", dat_expected_delivery = \"$deliveryDate\", dat_modified = \"$dateModified\", "
                . "txt_modified_by = \"$modifiedBy\", ysn_approved = 1, "
                . "txt_courier_status = \"$courierStatus\" "
                . "WHERE int_courier_booking_id = $courierBookingId";
        include_once '../../code/Utilities.php';
        $utilities = new Utilities();
//        echo '<pre>';print_r($query);exit;
        if($utilities->executeQuery($query)){
            //  data saved
            $q = "updated";
        } else {
            //  something went wrong
            $q = "error";
        }
//            echo '<pre>';print_r($query);exit;
        echo "<script>window.location.href='../courier-package.php?q=".$q."';</script>";
    }
}

/*
 * delete Courier Package
 */
function deleteCourierPackage($arrGet){
    $q = "error";
    if(!empty($courierId = $arrGet['courierId'])){
        $query = "UPDATE tbl_courier_booking SET ysn_deleted = 1 WHERE int_courier_booking_id = $courierId";
        include_once '../../code/Utilities.php';
        $utilities = new Utilities();
        if($utilities->executeQuery($query)){
            //  data saved
            $q = "deleted";
        }
    }
    echo "<script>window.location.href='../courier-package.php?q=".$q."';</script>";
}

/*
 * giveFeedback($arrPost)
 */
function giveFeedback($arrPost){
        $q = "error";
    if(!empty($name = $arrPost['txt_name']) && !empty($feedback = $arrPost['txt_feedback'])){
        $number = (!empty($arrPost['txt_number']) ? $arrPost['txt_number'] : '');
        $email = (!empty($arrPost['txt_email']) ? $arrPost['txt_email'] : '');
        $dateCreated = date('Y-m-d', strtotime('now'));
        session_start();
        $createdBy = (!empty($_SESSION['name']) ? $_SESSION['name'] : '');
        $query = "INSERT INTO tbl_feedback (txt_name, txt_number, txt_email, txt_feedback, dat_created, txt_created_by) "
                . "VALUES (\"$name\", \"$number\", \"$email\", \"$feedback\", \"$dateCreated\", \"$createdBy\")";
        include_once '../../code/Utilities.php';
        $utilities = new Utilities();
        $q = "error";
//        echo '<pre>';print_r($query);exit;
        if($utilities->executeQuery($query)){
            //  data saved
            $q = "saved";
        }
    }
    echo "<script>window.location.href='../feedback.php?q=".$q."';</script>";
}

/*
 * getFeeddback($arrPost)
 */
function getFeedback($arrPost){
    if(!empty($feeddbackId = $arrPost['feeddbackId'])){
        include_once '../../code/Utilities.php';
        $query = "SELECT int_feedback_id, txt_name, txt_number, "
                . "txt_email, txt_feedback "
                . "FROM tbl_feedback WHERE int_feedback_id = $feeddbackId AND ysn_deleted=0";
        $utilities = new Utilities();
//                    echo '<pre>';print_r($query);exit;
        if($result = $utilities->selectQuery($query)){
            if(!empty($result)){
                while ($rows = $result->fetch_array()){
                    echo json_encode($rows);
                }
            }
        }
    }
}


/*
 * giveFeedback($arrPost)
 */
function updateFeedback($arrPost){
        $q = "error";
    if(!empty($name = $arrPost['txt_name']) && !empty($feedback = $arrPost['txt_feedback']) &&
            !empty($feedbackId = $arrPost['int_feedback_id'])){
        $number = (!empty($arrPost['txt_number']) ? $arrPost['txt_number'] : '');
        $email = (!empty($arrPost['txt_email']) ? $arrPost['txt_email'] : '');
        $dateModified = date('Y-m-d', strtotime('now'));
        session_start();
        $modifiedBy = (!empty($_SESSION['name']) ? $_SESSION['name'] : '');
        $query = "UPDATE tbl_feedback SET txt_name = \"$name\", txt_number = \"$number\", txt_email = \"$email\", "
                . "txt_feedback = \"$feedback\", dat_created = \"$dateModified\", txt_created_by = \"$modifiedBy\", "
                . "ysn_approved = 1 "
                . " WHERE int_feedback_id = $feedbackId";
        include_once '../../code/Utilities.php';
        $utilities = new Utilities();
        $q = "error";
//        echo '<pre>';print_r($query);exit;
        if($utilities->executeQuery($query)){
            //  data saved
            $q = "updated";
        }
    }
    echo "<script>window.location.href='../feedback.php?q=".$q."';</script>";
}

/*
 * delete Courier Package
 */
function deleteFeedback($arrGet){
    $q = "error";
    if(!empty($feedbackId = $arrGet['feedbackId'])){
        $query = "UPDATE tbl_feedback SET ysn_deleted = 1 WHERE int_feedback_id = $feedbackId";
        include_once '../../code/Utilities.php';
        $utilities = new Utilities();
        if($utilities->executeQuery($query)){
            //  data saved
            $q = "deleted";
        }
    }
    echo "<script>window.location.href='../feedback.php?q=".$q."';</script>";
}

/*
 * giveFeedback($arrPost)
 */
function giveComplaint($arrPost){
        $q = "error";
    if(!empty($name = $arrPost['txt_name']) && !empty($complaint = $arrPost['txt_complaint'])){
        $number = (!empty($arrPost['txt_number']) ? $arrPost['txt_number'] : '');
        $email = (!empty($arrPost['txt_email']) ? $arrPost['txt_email'] : '');
        $dateCreated = date('Y-m-d', strtotime('now'));
        session_start();
        $createdBy = (!empty($_SESSION['name']) ? $_SESSION['name'] : '');
        $query = "INSERT INTO tbl_complaint (txt_name, txt_number, txt_email, txt_complaint, dat_created, txt_created_by) "
                . "VALUES (\"$name\", \"$number\", \"$email\", \"$complaint\", \"$dateCreated\", \"$createdBy\")";
        include_once '../../code/Utilities.php';
        $utilities = new Utilities();
        $q = "error";
//        echo '<pre>';print_r($query);exit;
        if($utilities->executeQuery($query)){
            //  data saved
            $q = "saved";
        }
    }
    echo "<script>window.location.href='../complaint.php?q=".$q."';</script>";
}

/*
 * getFeeddback($arrPost)
 */
function getComplaint($arrPost){
    if(!empty($feeddbackId = $arrPost['feeddbackId'])){
        include_once '../../code/Utilities.php';
        $query = "SELECT int_complaint_id, txt_name, txt_number, "
                . "txt_email, txt_complaint "
                . "FROM tbl_complaint WHERE int_complaint_id = $feeddbackId AND ysn_deleted=0";
        $utilities = new Utilities();
//                    echo '<pre>';print_r($query);exit;
        if($result = $utilities->selectQuery($query)){
            if(!empty($result)){
                while ($rows = $result->fetch_array()){
                    echo json_encode($rows);
                }
            }
        }
    }
}


/*
 * giveComplaint($arrPost)
 */
function updateComplaint($arrPost){
        $q = "error";
    if(!empty($name = $arrPost['txt_name']) && !empty($complaint = $arrPost['txt_complaint']) &&
            !empty($complaintId = $arrPost['int_complaint_id'])){
        $number = (!empty($arrPost['txt_number']) ? $arrPost['txt_number'] : '');
        $email = (!empty($arrPost['txt_email']) ? $arrPost['txt_email'] : '');
        $dateModified = date('Y-m-d', strtotime('now'));
        session_start();
        $modifiedBy = (!empty($_SESSION['name']) ? $_SESSION['name'] : '');
        $query = "UPDATE tbl_complaint SET txt_name = \"$name\", txt_number = \"$number\", txt_email = \"$email\", "
                . "txt_complaint = \"$complaint\", dat_created = \"$dateModified\", "
                . "txt_created_by = \"$modifiedBy\", ysn_approved = 1  "
                . " WHERE int_complaint_id = $complaintId";
        include_once '../../code/Utilities.php';
        $utilities = new Utilities();
        $q = "error";
//        echo '<pre>';print_r($query);exit;
        if($utilities->executeQuery($query)){
            //  data saved
            $q = "updated";
        }
    }
    echo "<script>window.location.href='../complaint.php?q=".$q."';</script>";
}

/*
 * delete Courier Package
 */
function deleteComplaint($arrGet){
    $q = "error";
    if(!empty($complaintId = $arrGet['complaintId'])){
        $query = "UPDATE tbl_complaint SET ysn_deleted = 1 WHERE int_complaint_id = $complaintId";
        include_once '../../code/Utilities.php';
        $utilities = new Utilities();
        if($utilities->executeQuery($query)){
            //  data saved
            $q = "deleted";
        }
    }
    echo "<script>window.location.href='../complaint.php?q=".$q."';</script>";
}

/*
 * giveFeedback($arrPost)
 */
function giveReview($arrPost){
        $q = "error";
    if(!empty($name = $arrPost['txt_name']) && !empty($review = $arrPost['txt_review']) && 
            !empty($ratings = $arrPost['tinyint_review'])
            ){
        $number = (!empty($arrPost['txt_number']) ? $arrPost['txt_number'] : '');
        $email = (!empty($arrPost['txt_email']) ? $arrPost['txt_email'] : '');
        $dateCreated = date('Y-m-d', strtotime('now'));
        session_start();
        $createdBy = (!empty($_SESSION['name']) ? $_SESSION['name'] : '');
        $query = "INSERT INTO tbl_review (txt_name, txt_number, txt_email, txt_review, tinyint_review,"
                . " dat_created, txt_created_by) "
                . "VALUES (\"$name\", \"$number\", \"$email\", \"$review\", \"$ratings\","
                . " \"$dateCreated\", \"$createdBy\")";
        include_once '../../code/Utilities.php';
        $utilities = new Utilities();
//        echo '<pre>';print_r($query);exit;
        if($utilities->executeQuery($query)){
            //  data saved
            $q = "saved";
        }
    }
    echo "<script>window.location.href='../review.php?q=".$q."';</script>";
}

/*
 * getFeeddback($arrPost)
 */
function getReview($arrPost){
    if(!empty($feeddbackId = $arrPost['feeddbackId'])){
        include_once '../../code/Utilities.php';
        $query = "SELECT int_review_id, txt_name, txt_number, tinyint_review, "
                . "txt_email, txt_review "
                . "FROM tbl_review WHERE int_review_id = $feeddbackId AND ysn_deleted=0";
        $utilities = new Utilities();
//                    echo '<pre>';print_r($query);exit;
        if($result = $utilities->selectQuery($query)){
            if(!empty($result)){
                while ($rows = $result->fetch_array()){
                    echo json_encode($rows);
                }
            }
        }
    }
}


/*
 * giveReview($arrPost)
 */
function updateReview($arrPost){
    if(!empty($name = $arrPost['txt_name']) && !empty($review = $arrPost['txt_review']) &&
            !empty($ratings = $arrPost['tinyint_review']) && !empty($reviewId = $arrPost['int_review_id'])){
        $number = (!empty($arrPost['txt_number']) ? $arrPost['txt_number'] : '');
        $email = (!empty($arrPost['txt_email']) ? $arrPost['txt_email'] : '');
        $dateModified = date('Y-m-d', strtotime('now'));
        session_start();
        $modifiedBy = (!empty($_SESSION['name']) ? $_SESSION['name'] : '');
        $query = "UPDATE tbl_review SET txt_name = \"$name\", txt_number = \"$number\", txt_email = \"$email\", "
                . "txt_review = \"$review\", tinyint_review = \"$ratings\", dat_created = \"$dateModified\", "
                . "txt_created_by = \"$modifiedBy\", ysn_approved = 1 "
                . " WHERE int_review_id = $reviewId";
        include_once '../../code/Utilities.php';
        $utilities = new Utilities();
        $q = "error";
//        echo '<pre>';print_r($query);exit;
        if($utilities->executeQuery($query)){
            //  data saved
            $q = "updated";
        }
    }
    echo "<script>window.location.href='../review.php?q=".$q."';</script>";
}

/*
 * delete Courier Package
 */
function deleteReview($arrGet){
    $q = "error";
    if(!empty($reviewId = $arrGet['reviewId'])){
        $query = "UPDATE tbl_review SET ysn_deleted = 1 WHERE int_review_id = $reviewId";
        include_once '../../code/Utilities.php';
        $utilities = new Utilities();
        if($utilities->executeQuery($query)){
            //  data saved
            $q = "deleted";
        }
    }
    echo "<script>window.location.href='../review.php?q=".$q."';</script>";
}

/*
 * update Approve Status ($arrPost)
 */
function updateApproveStatus($arrPost){
    echo '111';exit;
    $q = "ERROR";
    if(!empty($courierId = $arrPost['courierId']) && !empty($action = $arrPost['action'])){
        echo $courierId.$action;exit;
        ($action == "Approve" ? $action = 1 : $action = 0);
        ($action == "Decide Later" ? $action = 0 : $action = 0);
        ($action == "Decline Request" ? $action = 2 : $action = 0);
        $query = "UPDATE tbl_courier_booking SET ysn_approved = \"$action\" "
                . "WHERE int_courier_booking_id = $courierId";
        include_once '../../code/Utilities.php';
        $utilities = new Utilities();
        echo '<pre>';print_r($query);exit;
        if($utilities->executeQuery($query)){
            //  data saved
            $q = "updated";
        }
        echo $q;
    }
}