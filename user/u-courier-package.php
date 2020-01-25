<?php
session_start();
if (empty($_SESSION) || empty($_SESSION['name']) || empty($_SESSION['number']) || empty($_SESSION['email'])) {
    session_destroy();
    echo "<script>window.location.href='../login.php';</script>";
}
?>
<!DOCTYPE html>
<?php
include_once '.././constants.php';
$adminType = 1;
$adminType = ($adminType == 2 ? "hidden" : "");
?>
<html>
    <head>

        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/5249859935.js" crossorigin="anonymous"></script>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <link href="../img/lg.jpg" rel="icon" type="favicon" />
        <link href="../css/index.css" rel="stylesheet" type="text/css"/>
        <style>
            @media (max-width: 330px) {  
                .h1-font-size, .phone-font-size {font-size: 5vw;} /*1rem = 16px*/
                .h2-font-size {font-size: 3vw;} /*1rem = 16px*/
            }
            /*@media (min-width: 220px) {  
                .h1-font-size {font-size:1rem;} 1rem = 16px
            }*/
            @media (min-width: 330px) {  
                .h1-font-size {font-size:1rem;}   
                .h2-font-size {font-size:0.5rem;}  
            }
            @media (min-width: 544px) {  
                .h1-font-size {font-size:1rem;}   
                .h2-font-size {font-size:0.5rem;}  
            }

            /* Medium devices (tablets, 768px and up) The navbar toggle appears at this breakpoint */
            @media (min-width: 768px) {  
                .h1-font-size {font-size:1.5rem;}  
                .h2-font-size {font-size:1rem;}  
            }

            /* Large devices (desktops, 992px and up) */
            @media (min-width: 992px) { 
                .h1-font-size {font-size:2rem;}   
                .h2-font-size {font-size:1rem;}  
            }

            /* Extra large devices (large desktops, 1200px and up) */
            @media (min-width: 1200px) {  
                .h1-font-size {font-size:2rem;}    
                .h2-font-size {font-size:1.5rem;}    
            }
            .font-size{
                font-size: 2rem;
            }
            html{
                scroll-behavior: smooth;
            }
            .tr-text-success{
                color: #1E8449;
            }
            .separator {
                display: flex;
                align-items: center;
                text-align: center;
                margin-bottom: -2%;
            }
            .separator::before, .separator::after {
                content: '';
                flex: 1;
                border-bottom: 3px solid #000;
            }
            .separator::before {
                margin-right: 1.25em;
            }
            .separator::after {
                margin-left: 1.25em;
            }
            a.disabled {
                pointer-events: none;
                cursor: default;
            }.animation{
                animation:blinkingText 1s infinite;
                color: red;
                font-weight: bold;
            }
            @keyframes blinkingText{
                0%{color: #fff;}
                49%{color: red;}
                50%{color: red;}
                99%{color:red;}
                100%{color: #000;}
            }
            .border-width-2{
                border-width: 2px !important;
            }
            .autocomplete {
                position: relative;
                display: inline-block;
            }
            .autocomplete-items {
                position: absolute;
                border: 1px solid #d4d4d4;
                border-bottom: none;
                border-top: none;
                z-index: 99;
                /*position the autocomplete items to be the same width as the container:*/
                top: 100%;
                left: 0;
                right: 0;
            }

            .autocomplete-items div {
                padding: 10px;
                cursor: pointer;
                background-color: #fff; 
                border-bottom: 1px solid #d4d4d4; 
            }

            /*when hovering an item:*/
            .autocomplete-items div:hover {
                background-color: #e9e9e9; 
            }

            /*when navigating through the items using the arrow keys:*/
            .autocomplete-active {
                background-color: DodgerBlue !important; 
                color: #ffffff; 
            }
        </style>
        <script>
            /*
             * get time and date
             */
            function getTimeAndDate() {
                to = $(".to").val();
                from = $(".from").val();
                weight = $(".weight").val();
                bookingDate = $(".bookingDate").val();
//                alert(to);
                dateEntered = new Date(bookingDate.split("-")[0], bookingDate.split("-")[1] - 1, bookingDate.split("-")[2]);
                var date = new Date();
                today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
//                alert(dateEntered+"\n"+today);
                if (to.length > 0 && to.length != 0 && from.length > 0 && from.length != 0 && weight.length > 0 && weight.length != 0 && bookingDate.length > 0 && bookingDate.length != 0) {
                    if (dateEntered >= today) {
                        $(".requiredFields").removeClass("animation");
                        $.ajax({
                            url: "../code/ajaxRequest.php?action=timeAndPrice",
                            type: 'POST',
                            dataType: 'JSON',
                            data: {to: to, from: from, weight: weight, bookingDate: bookingDate},
                            beforeSend: function () {
                                // Show image container
                                $(".handle-spinner").show();
                            },
                            success: function (result) {
                                $(".table-data-content").removeAttr("hidden", "");
                                $("#documentPrice").html(result['documentPrice']);
                                $("#documentDate").html(result['documentDeliveryDate']);
                                $("#airPrice").html(result['airPrice']);
                                $("#airDate").html(result['airDeliveryDate']);
                                $("#groundPrice").html(result['groundPrice']);
                                $("#groundDate").html(result['groundDeliveryDate']);
                                if (result == "ERROR") {
                                    alert(result);
                                }
                            },
                            complete: function (result) {
                                // Hide image container
                                $(".handle-spinner").hide();
                            },
                            statusCode: {
                                404: function () {
                                    alert("Something went wrong");
                                }
                            }
                        });
                    } else {
                        alert("Booking date is earlier than today.");
                    }
                } else {
                    $(".requiredFields").addClass("animation");
                }
            }

            /*
             * hide table and details associated
             */
            function hideTable() {
                $(".table-data-content").attr("hidden", "");

            }

            /*
             * getAddressData()
             */
            function getFromAddressData(from) {
                $(".from").val(trimTheInput(from));
                $.ajax({
                    url: "../code/ajaxRequest.php?action=from",
                    type: 'POST',
//                    dataType: 'JSON',
                    data: {from: from},
                    beforeSend: function () {
                        // Show image container
//                        $(".handle-spinner").show();
                    },
                    success: function (result) {
//                alert(result);
                        $(".from-box").show();
                        $(".from-box").html(result);
                        $(".from").css("background", "#FFF");
                        if (result == "ERROR") {
                        }
                    },
                    complete: function (result) {
                        // Hide image container
                        $(".handle-spinner").hide();
                    },
                    statusCode: {
                        404: function () {
                            alert("Something went wrong");
                        }
                    }
                });
            }

            /*
             * getAddressData()
             */
            function getToAddressData(to) {
                $(".to").val(trimTheInput(to));
                $.ajax({
                    url: "../code/ajaxRequest.php?action=to",
                    type: 'POST',
//                    dataType: 'JSON',
                    data: {to: to},
                    beforeSend: function () {
                        // Show image container
//                        $(".handle-spinner").show();
                    },
                    success: function (result) {
                        $("#to-box").show();
                        $("#to-box").html(result);
                        $(".to").css("background", "#FFF");
                        if (result == "ERROR") {
                        }
                    },
                    complete: function (result) {
                        // Hide image container
                        $(".handle-spinner").hide();
                    },
                    statusCode: {
                        404: function () {
                            alert("Something went wrong");
                        }
                    }
                });
            }

            function selectFrom(val) {
                $("#from").val(val);
                $("#from-box").hide();
            }

            function selectTo(val) {
                $("#to").val(val);
                $("#to-box").hide();
            }

            /*
             * trim function value
             */
            function trimTheInput(text) {
                return text.replace(/ +(?= )/g, '');
            }

            /*
             * document 
             */
            function shipAsDocument() {
                $action = $("#book-courier-package-form").attr("action");
                $documentPrice = $("#documentPrice").text();
                $documentDate = $("#documentDate").text();
                $action = $action + "&service=Document&deliveryDate=" + $documentDate + "&price=" + $documentPrice;
                $("#book-courier-package-form").attr("action", $action);
                $("#book-courier-package-form").submit();
            }
            /*
             * ship by Air 
             */
            function shipByAir() {
                $action = $("#book-courier-package-form").attr("action");
                $airPrice = $("#airPrice").text();
                $airDate = $("#airDate").text();
                $action = $action + "&service=Air&deliveryDate=" + $airDate + "&price=" + $airPrice;
                $("#book-courier-package-form").attr("action", $action);
                $("#book-courier-package-form").submit();
            }
            /*
             * ship by Ground
             */
            function shipByGround() {
                $action = $("#book-courier-package-form").attr("action");
                $groundPrice = $("#groundPrice").text();
                $groundDate = $("#groundDate").text();
                $action = $action + "&service=Ground&deliveryDate=" + $groundDate + "&price=" + $groundPrice;
                $("#book-courier-package-form").attr("action", $action);
                $("#book-courier-package-form").submit();
            }
            
            /*
             * get-booked-courier-data
             */
            function getBookedCourierData() {
                $(document).on("click", ".data-edit", function () {
                    var courierId = $(this).attr("id");
                    $.ajax({
                        url: 'code/u-ajaxRequest.php?action=get-booked-courier-data',
                        method: 'POST',
                        data: {courierId: courierId},
                        dataType: 'json',
                        success: function (data) {
                            $('#int_courier_booking_id').val(data.int_courier_booking_id);
                            $('#senderName').val(data.txt_sender_name);
                            $('#senderNumber').val(data.txt_sender_mobile);
                            $('#senderEmail').val(data.txt_sender_email);
                            $('#senderAddressLine1').val(data.txt_sender_address_line1);
                            $('#origin').val(data.txt_origin);
                            $('#courierItem').val(data.txt_courier_item_content);
                            $('#courierWeight').val(data.txt_weight);
                            $('#courierItemPieces').val(data.int_courier_item_pieces);
                            $('#recipientName').val(data.txt_recipient_name);
                            $('#recipientNumber').val(data.txt_recipient_mobile);
                            $('#recipientAlternativeNumber').val(data.txt_recipient_alternate_mobile);
                            $('#recipientEmail').val(data.txt_recipient_email);
                            $('#recipientAddressLine1').val(data.txt_recipient_address_line1);
                            $('#destination').val(data.txt_destination);
                            $('#dateBooked').val(data.dat_booked);
                            $('#txt_service_type').val(data.txt_transport_mode);
                            $('#updateCourierPackage').modal('show');
                        }
                    });
                });
            }
            
            /*
             * get-booked-courier-data
             */
            function getBookedCourierDataInView() {
                $(document).on("click", ".data-view", function () {
                    var courierId = $(this).attr("id");
                    $.ajax({
                        url: 'code/u-ajaxRequest.php?action=get-booked-courier-data',
                        method: 'POST',
                        data: {courierId: courierId},
                        dataType: 'json',
                        success: function (data) {
                            $('.int_courier_booking_id').val(data.int_courier_booking_id);
                            $('.senderName').val(data.txt_sender_name);
                            $('.senderNumber').val(data.txt_sender_mobile);
                            $('.senderEmail').val(data.txt_sender_email);
                            $('.senderAddressLine1').val(data.txt_sender_address_line1);
                            $('.origin').val(data.txt_origin);
                            $('.courierItem').val(data.txt_courier_item_content);
                            $('.courierWeight').val(data.txt_weight);
                            $('.courierItemPieces').val(data.int_courier_item_pieces);
                            $('.recipientName').val(data.txt_recipient_name);
                            $('.recipientNumber').val(data.txt_recipient_mobile);
                            $('.recipientAlternativeNumber').val(data.txt_recipient_alternate_mobile);
                            $('.recipientEmail').val(data.txt_recipient_email);
                            $('.recipientAddressLine1').val(data.txt_recipient_address_line1);
                            $('.destination').val(data.txt_destination);
                            $('.dateBooked').val(data.dat_booked);
                            $('.txt_service_type').val(data.txt_transport_mode);
                            $('#viewCourierPackage').modal('show');
                        }
                    });
                });
            }

            /*
             * get-booked-courier-data
             */
            function deleteBookedCourierData(courierId) {
                var res = confirm("Are you sure to delete this item?");
                if(res){
                    window.location.href = "code/u-ajaxRequest.php?action=delete-booked-courier-data&courierId="+courierId;
                }
            }

        </script>
    </head>
    <body class="bg-light" oncontextmenu="return false;">
        <noscript>
        <meta HTTP-EQUIV="refresh" content=0;url="javascriptNotEnabled.html">
        <style type="text/css">
            .container-fluid { display:none; }
        </style>
        </noscript>
        <div class="container-fluid bg-light">
            <?php
            include_once './userHeader.php';
            include_once '../code/Utilities.php';
            $utilities = new Utilities();
            include_once '../constants.php';
            if (!empty($_GET['q'])) {
                $errorDetail = "";
                $errorColor = "alert-danger text-danger";
                $q = $_GET['q'];
                if ($q == 'saved') {
                    $errorDetail = "Saved Successfully.";
                    $errorColor = "alert-success text-success";
                } else if ($q == 'error') {
                    $errorDetail = "Something went wrong.";
                } else if($q == 'updated'){
                    $errorDetail = "Updated Successfully.";
                    $errorColor = "alert-success text-success";
                } else if($q == 'deleted'){
                    $errorDetail = "Deleted Successfully.";
                    $errorColor = "alert-success text-success";
                }
            }
            if (!empty($errorDetail)) {
                ?>
                <div class="alert <?= $errorColor ?> alert-dismissible font-weight-bold fade show text-center" role="alert">
                    <?= $errorDetail ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            <div class="container ">
                <div class="col-sm-12 my-4" id="user">
                    <div class="separator">
                        <h4 class="ask font-weight-bold fa-2x text-center">Courier Package </h4>
                    </div>
                </div>
            </div>
            <?php
            $utilities = new Utilities();
            $startingIndex = 0;
            $pageLimit = 10;
            if (!empty($_GET['page'])) {
                $startingIndex = ($_GET['page'] - 1) * 10;
//                        echo '<pre>';print_r($pageLimit);
            }
            $rows['0'] = $rows['1'] = $rows['2'] = $rows['3'] = '';
            $totalCustomerCount = 0;
            $queryCount = "SELECT count(*) FROM tbl_courier_booking WHERE ysn_deleted=0";
            if ($result = $utilities->selectQuery($queryCount)) {
                if ($rows = $result->fetch_array()) {
                    $totalCustomerCount = $rows['0'];
                }
            }
            ?>
            <div class="row mb-2">
                <div class="col">
                    <button class="btn btn-lg btn-secondary text-white  font-weight-bold"
                            style="cursor: text;"
                            title='Total Products <?= $totalCustomerCount ?>'>
                        <i class="fas fa-box-open"></i> &nbsp;
                        <?= $totalCustomerCount ?>
                    </button>
                </div>
                <div class="col">
                    <a href="#" <?= $adminType ?> class="btn btn-lg float-right btn-secondary"
                       style="cursor: pointer;" title="dfsdfd" data-toggle="modal" data-target="#bookCourierPackage">
                        <i class="fas fa-plus-square"></i>
                    </a>
                </div>
            </div>
            <div class="row" style="min-height: 365px;">
                <div class="col">
                    <div class="col bg-light text-center font-weight-bold page-links rounded-top">
                        <?php
                        $pageCount = ceil($totalCustomerCount / 10);
                        for ($i = 1; $i <= $pageCount; $i++) {
                            ?>
                            <a href="?page=<?= $i ?>" class="links text-primary"><?= $i ?></a>
                            <?php
                        }
                        ?>
                    </div>
                    <table class="m-0 table table-bordered table-striped table-responsive table-secondary text-center w-100 d-block d-lg-table">
                        <?php
//                        include_once './Utilities.php';
                        $query = "SELECT * FROM tbl_courier_booking WHERE ysn_deleted=0 "
                                . "ORDER BY dat_booked DESC LIMIT $startingIndex, $pageLimit";
//                        echo $query;exit;
                        if ($result = $utilities->selectQuery($query)) {
                            ?>
                            <tr class="bg-secondary text-white">
                                <th>S.No.</th>
                                <th>Sender</th>
                                <th>Item</th>
                                <th>Weight</th>
                                <th>Origin</th>
                                <th>Recipient</th>
                                <th>Destination</th>
                                <th>Service</th>
                                <th>Date Booked</th>
                                <th>Price</th>
                                <th>Delivery Date</th>
                                <th <?= $adminType ?>>Action</th>
                            </tr>
                            <?php
                            while ($rows = $result->fetch_array()) {
//                                echo '<pre>';print_r($rows);exit;
                                $txtColorGreen = "badge-danger";
                                $txtTitle = "Not Approved";
                                if($rows['ysn_approved'] == 1){
                                    $txtTitle = "Approved";
                                    $txtColorGreen = "badge-success";
                                }
                                ?>
                                <tr class="table-body mark-row-<?= $rows['0'] ?>">
                                    <td class="badge <?=$txtColorGreen?> badge-pill mt-1" 
                                        style="cursor: pointer;"
                                        title="<?=$txtTitle?>">
                                        <?= ++$startingIndex; ?></td>
                                    <td class="txt_name-<?= $rows['0'] ?>" 
                                        id="cust_name-<?= $rows['0'] ?>" 
                                        name="txt_name-<?= $rows['0'] ?>"><?= $rows['txt_sender_name'] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        id="cust_number-<?= $rows['0'] ?>"
                                        name="txt_number-<?= $rows['0'] ?>"><?= $rows['txt_courier_item_content'] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        id="cust_email-<?= $rows['0'] ?>"
                                        name="txt_email-<?= $rows['0'] ?>"><?= $rows['txt_weight'] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        id="cust_address-<?= $rows['0'] ?>"
                                        name="txt_address-<?= $rows['0'] ?>"><?= explode(" -", $rows['txt_origin'])[0] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        id="cust_city-<?= $rows['0'] ?>"
                                        name="txt_city-<?= $rows['0'] ?>"><?= $rows['txt_recipient_name'] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        id="cust_state-<?= $rows['0'] ?>"
                                        name="txt_state-<?= $rows['0'] ?>"><?= explode(" -", $rows['txt_destination'])[0] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        id="cust_city-<?= $rows['0'] ?>"
                                        name="txt_city-<?= $rows['0'] ?>"><?= $rows['txt_transport_mode'] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        id="cust_city-<?= $rows['0'] ?>"
                                        name="txt_city-<?= $rows['0'] ?>"><?= $rows['dat_booked'] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        id="cust_state-<?= $rows['0'] ?>"
                                        name="txt_state-<?= $rows['0'] ?>"><?= $rows['txt_price'] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        id="cust_city-<?= $rows['0'] ?>"
                                        name="txt_city-<?= $rows['0'] ?>"><?= $rows['dat_expected_delivery'] ?></td>

                                    <td <?= $adminType ?> >
                                        <a 
                                            class="text-dark data-view" 
                                            onclick="getBookedCourierDataInView()"
                                            id='<?= $rows['int_courier_booking_id'] ?>'
                                            style="cursor: pointer;"
                                            title="View">
                                            <span class="fas fa-eye"></span>
                                        </a>
                                        &nbsp;
                                        <a 
                                            class="text-dark data-edit" 
                                            onclick="getBookedCourierData()"
                                            id='<?= $rows['int_courier_booking_id'] ?>'
                                            style="cursor: pointer;"
                                            title="Modify">
                                            <span class="fas fa-edit"></span>
                                        </a>
                                        &nbsp;
                                        <a onclick="deleteBookedCourierData(<?= $rows['0'] ?>)" 
                                           class="text-dark data-delete" 
                                           style="cursor: pointer;"
                                           title="Delete">
                                            <span class="fas fa-trash"></span>
                                        </a>
                                        <!--<i class="fa fa-check-circle text-success" title="approved"></i>-->
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="card " style="min-height: 450px;">
                                <button class="text-center bg-secondary text-white font-weight-bold" style="min-height: 50px; cursor: auto">
                                    <?php
                                    if (!empty(ceil($totalCustomerCount / 10))) {
                                        ?>
                                        No data found, please visit page <?= ceil($totalCustomerCount / 10) ?> <span><i class="fas fa-arrow-down"></i></span>
                                        <?php
                                    } else {
                                        echo "No data found";
                                    }
                                    ?>
                                </button>
                            </div>
                            <?php
                        }
                        ?>
                    </table>
                    <div class="col bg-light text-center font-weight-bold mb-4 page-links">
                        <?php
                        $pageCount = ceil($totalCustomerCount / 10);
                        for ($i = 1; $i <= $pageCount; $i++) {
                            ?>
                            <a href="?page=<?= $i ?>" class="links text-primary"><?= $i ?></a>
                            <?php
                        }
                        ?>
                    </div>
                    <?php include_once '../goToTop.php'; ?>
                </div>
            </div>
            <div class="row mt-2 mb-4">
                <div class="col">
                    <button class="btn btn-lg btn-secondary text-white font-weight-bold"
                            style="cursor: text;"
                            title='Total Products <?= $totalCustomerCount ?>'>
                        <i class="fas fa-box-open"></i> &nbsp;
                        <?= $totalCustomerCount ?>
                    </button>
                </div>
            </div>
        </div>
        <?php include_once 'userFooter.php'; ?>
    </body>
</html>




<!-- Create Modal -->
<div class="modal fade" id="bookCourierPackage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Book Courier Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="code/u-ajaxRequest.php?action=bookCourierPackage" 
                      method="post" 
                      id="book-courier-package-form"
                      enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_sender_name" class="col-form-label font-weight-bold">Sender's(S) Name<sup class="text-danger font-weight-bold">*</sup>: </label>
                            <div class="">
                                <input type="text" class="form-control" id="txt_sender_name" name="txt_sender_name" 
                                       value="<?= $_SESSION['name'] ?>"
                                       aria-describedby="txt_sender_name_help" placeholder="Sender Name" required="true">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_sender_number" class="col-form-label font-weight-bold">Sender's Mobile<sup class="text-danger font-weight-bold">*</sup>: </label>
                            <div class="">
                                <input type="number" class="form-control" id="txt_sender_number" name="txt_sender_number" 
                                       value="<?= $_SESSION['number'] ?>"
                                       aria-describedby="txt_sender_number_help" placeholder="Sender Number" required="true">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_sender_email" class="col-form-label font-weight-bold">Sender's Email: </label>
                            <div class="">
                                <input type="email" class="form-control" id="txt_sender_email" name="txt_sender_email" 
                                       value="<?= $_SESSION['email'] ?>"
                                       aria-describedby="txt_sender_email_help" placeholder="Sender Email">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_sender_address_line1" class="col-form-label font-weight-bold">Sender's Address: </label>
                            <div class="">
                                <input type="text" class="form-control" id="txt_sender_address_line1" name="txt_sender_address_line1" 
                                       aria-describedby="txt_sender_address_line1_help" placeholder="H.N., Street">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="from" class="col-form-label font-weight-bold">Origin<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="text" autocomplete="off" class="form-control from" onclick="hideTable()" 
                                       onkeyup="getFromAddressData(this.value);trimTheInput(this.value)"  name="from" id="from"
                                       placeholder="Enter Location or Pincode" required="">
                                <div class="from-box" id="from-box" style="display: none;"></div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_courier_item" class="col-form-label font-weight-bold">Item<sup class="text-danger font-weight-bold">*</sup>: </label>
                            <div class="">
                                <input type="text" class="form-control" id="txt_sender_name" name="txt_courier_item" 
                                       aria-describedby="txt_courier_item" placeholder="Courier Item" required="true">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_courier_item_pieces" class="col-form-label font-weight-bold">Pieces: </label>
                            <div class="">
                                <input type="number" class="form-control" id="txt_sender_name" name="txt_courier_item_pieces" 
                                       aria-describedby="txt_courier_item_pieces" placeholder="Courier Item Pieces" >
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="weight" class="col-form-label font-weight-bold">Weight (in kgs)<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="number" class="form-control weight" onclick="hideTable()" name="weight" id="weight"
                                       placeholder="kgs" required="" >
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_recipient_name" class="col-form-label font-weight-bold">Recipient's Name<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="text" class="form-control" id="txt_recipient_name" name="txt_recipient_name" 
                                       aria-describedby="txt_recipient_name" placeholder="Recipient Name" required="true">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_recipient_number" class="col-form-label font-weight-bold">Recipient's Mobile<sup class="text-danger font-weight-bold">*</sup>: </label>
                            <div class="">
                                <input type="number" class="form-control" id="txt_recipient_number" name="txt_recipient_number" 
                                       aria-describedby="txt_recipient_number" placeholder="Recipient Number" required="true">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_recipient_alternate_number" class="col-form-label font-weight-bold">Alternate Mobile: </label>
                            <div class="">
                                <input type="number" class="form-control" id="txt_recipient_alternate_number" name="txt_recipient_alternate_number" 
                                       aria-describedby="txt_recipient_alternate_number" placeholder="Recipient Alternate Number" >
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_recipient_email" class="col-form-label font-weight-bold">Recipient's Email: </label>
                            <div class="">
                                <input type="email" class="form-control" id="txt_recipient_email" name="txt_recipient_email" 
                                       aria-describedby="txt_recipient_email" placeholder="Recipient Email">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_recipient_address_line1" class="col-form-label font-weight-bold">Recipient's Address<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="text" class="form-control" id="txt_recipient_address_line1" name="txt_recipient_address_line1" 
                                       aria-describedby="txt_recipient_address_line1_help" placeholder="H.N., Street" required="">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="to" class="font-weight-bold">Destination<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="text" autocomplete="off" class="form-control to" onclick="hideTable()" 
                                       onkeyup="getToAddressData(this.value)" name="to" id="to"
                                       placeholder="Enter a Location or Pincode" required="">
                                <div class="to-box" id="to-box" style="display: none;"></div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="bookingDate" class="font-weight-bold">Pick Up Date<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="text" class="form-control bookingDate" 
                                       onclick="hideTable()" value="<?php echo date('Y-m-d'); ?>"
                                       name="bookingDate" id="bookingDate"
                                       placeholder="DD-MM-YYYY" onfocus="(this.type = 'date')" required="">
                            </div>
                        </div>
                        <!--                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="validatedCustomFile" class="col-form-label font-weight-bold">Upload Image: </label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="file" id="validatedCustomFile" >
                                                        <label class="custom-file-label" for="validatedCustomFile">Choose File...</label>
                                                    </div>
                                                </div>-->
                    </div>
                    <div class="form-group mt-3 mb-5">
                        <input type="button" onclick="getTimeAndDate();hideTable();" class="btn btn-secondary mt-2 font-weight-bold" value="Find" />
                        <input type="reset" onclick="hideTable()" class="btn btn-secondary mt-2 font-weight-bold" value="Reset" />
                    </div>
                </form>
                <div class="text-center handle-spinner" style="display: none;">
                    <div class="spinner-border " role="status">
                        <span class="sr-only  mx-0">Loading...</span>
                    </div>
                </div>
                <div class="table-data-content" hidden="">
                    <table class="table table-bordered table-responsive-lg my-4">
                        <tr class="text-success" style="background-color: #e9e9e9;">
                            <th>Product & Services</th>
                            <th>Minimum Chargeable Weight (in kgs)<sup class="text-danger">#</sup></th>
                            <th>Expected Date of Delivery</th>
                            <th>You Pay<sup class="text-danger">##</sup></th>
                        </tr>
                        <tr class="">
                            <th>Document</th>
                            <td>0.5</td>
                            <td id="documentDate"></td>
                            <td id="documentPrice"></td>
                            <td><input type="button" 
                                       onclick="shipAsDocument()"
                                       name="documentPackage"
                                       class="btn btn-success font-weight-bold form-control" 
                                       value="Book Now" /></td>
                        </tr>
                        <tr class="">
                            <th>Air Package</th>
                            <td>1.0</td>
                            <td id="airDate"></td>
                            <td id="airPrice"></td>
                            <td><input type="button" 
                                       onclick="shipByAir()"
                                       name="airPackage"
                                       class="btn btn-success font-weight-bold form-control" 
                                       value="Book Now" /></td>
                        </tr>
                        <tr class="">
                            <th>Ground Packages</th>
                            <td>1.0</td>
                            <td id="groundDate"></td>
                            <td id="groundPrice"></td>
                            <td><input type="button" 
                                       onclick="shipByGround()"
                                       name="groundPackage"
                                       class="btn btn-success font-weight-bold form-control" 
                                       value="Book Now" /></td>
                        </tr>
                    </table>
                    <p class="">
                        <span class="text-danger font-weight-bold">#</span> Shipment will be re-weighed and re-measured. 
                        Prices quoted has been calculated based on the suggested weight of the shipment. 
                        <?= COMPANY_NAME ?>’s Shipment charges are calculated according to the higher of actual or volumetric weight. 
                        Post reweigh for online payment, if found to be heavier, 
                        the under collected amount will have to be paid in cash in order to process the shipment further, 
                        If the shipment is found to be lighter, the over collected amount will be refunded.
                    </p>
                    <p class="">
                        <span class="text-danger font-weight-bold">##</span> Prices quoted is estimated and would vary based on Value Added Services 
                        chosen by customer and final charges would be informed at the time of final 
                        booking confirmation. The prices quoted is inclusive of the Total freight costs, 
                        Fuels surcharges and GST.
                        Duties, taxes and customs charges if any will be additional.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Update Modal -->
<div class="modal fade" id="updateCourierPackage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Update Courier Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="code/u-ajaxRequest.php?action=updateCourierPackage" 
                      method="post" 
                      id="book-courier-package-form"
                      enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <input type="hidden" class="form-control" id="int_courier_booking_id" name="int_courier_booking_id" 
                                   aria-describedby="int_courier_booking_id" required="true">
                            <label for="txt_sender_name" class="col-form-label font-weight-bold">Sender's Name<sup class="text-danger font-weight-bold">*</sup>: </label>
                            <div class="">
                                <input type="text" class="form-control senderName" id="senderName" name="txt_sender_name" 
                                       value="<?= $_SESSION['name'] ?>"
                                       aria-describedby="txt_sender_name_help" placeholder="Sender Name" required="true">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_sender_number" class="col-form-label font-weight-bold">Sender's Mobile<sup class="text-danger font-weight-bold">*</sup>: </label>
                            <div class="">
                                <input type="number" class="form-control senderNumber" id="senderNumber" name="txt_sender_number" 
                                       value="<?= $_SESSION['number'] ?>"
                                       aria-describedby="txt_sender_number_help" placeholder="Sender Number" required="true">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_sender_email" class="col-form-label font-weight-bold">Sender's Email: </label>
                            <div class="">
                                <input type="email" class="form-control senderEmail" id="senderEmail" name="txt_sender_email" 
                                       value="<?= $_SESSION['email'] ?>"
                                       aria-describedby="txt_sender_email_help" placeholder="Sender Email">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_sender_address_line1" class="col-form-label font-weight-bold">Sender's Address: </label>
                            <div class="">
                                <input type="text" class="form-control senderAddressLine1" id="senderAddressLine1" name="txt_sender_address_line1" 

                                       aria-describedby="txt_sender_address_line1_help" placeholder="H.N., Street">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="from" class="col-form-label font-weight-bold">Origin<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="text" autocomplete="off" class="form-control from origin" onclick="hideTable()" 
                                       readonly=""
                                       onkeyup="getFromAddressData(this.value);trimTheInput(this.value)"  name="from" id="origin"
                                       placeholder="Enter Location or Pincode" required="">
                                <div class="from-box" id="from-box" style="display: none;"></div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_courier_item" class="col-form-label font-weight-bold">Item<sup class="text-danger font-weight-bold">*</sup>: </label>
                            <div class="">
                                <input type="text" class="form-control courierItem" id="courierItem" name="txt_courier_item" 
                                       aria-describedby="txt_courier_item" placeholder="Courier Item" required="true">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_courier_item_pieces" class="col-form-label font-weight-bold">Pieces: </label>
                            <div class="">
                                <input type="number" class="form-control courierItemPieces" id="courierItemPieces" name="txt_courier_item_pieces" 
                                       aria-describedby="txt_courier_item_pieces" placeholder="Courier Item Pieces" >
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="weight" class="col-form-label font-weight-bold weight">Weight (in kgs)<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="number" class="form-control courierWeight" onclick="hideTable()" name="weight" id="courierWeight"
                                       placeholder="kgs" required="" >
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_recipient_name" class="col-form-label font-weight-bold">Recipient's Name<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="text" class="form-control recipientName" id="recipientName" name="txt_recipient_name" 
                                       aria-describedby="txt_recipient_name" placeholder="Recipient Name" required="true">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_recipient_number" class="col-form-label font-weight-bold">Recipient's Mobile<sup class="text-danger font-weight-bold">*</sup>: </label>
                            <div class="">
                                <input type="number" class="form-control recipientNumber" id="recipientNumber" name="txt_recipient_number" 
                                       aria-describedby="txt_recipient_number" placeholder="Recipient Number" required="true">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_recipient_alternate_number" class="col-form-label font-weight-bold">Alternate Mobile: </label>
                            <div class="">
                                <input type="number" class="form-control recipientAlternativeNumber" id="recipientAlternativeNumber" name="txt_recipient_alternate_number" 
                                       aria-describedby="txt_recipient_alternate_number" placeholder="Recipient Alternate Number" >
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_recipient_email" class="col-form-label font-weight-bold">Recipient's Email: </label>
                            <div class="">
                                <input type="email" class="form-control recipientEmail" id="recipientEmail" name="txt_recipient_email" 
                                       aria-describedby="txt_recipient_email" placeholder="Recipient Email">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_recipient_address_line1" class="col-form-label font-weight-bold">Recipient's Address:<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="text" class="form-control recipientAddressLine1" id="recipientAddressLine1" name="txt_recipient_address_line1" 
                                       aria-describedby="txt_recipient_address_line1_help" placeholder="H.N., Street" required="">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="to" class="font-weight-bold">Destination<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="text" autocomplete="off" class="form-control to destination" onclick="hideTable()" 
                                       readonly=""
                                       onkeyup="getToAddressData(this.value)" name="to" id="destination"
                                       placeholder="Enter a Location or Pincode" required="">
                                <div class="to-box" id="to-box" style="display: none;"></div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="bookingDate" class="font-weight-bold">Pick Up Date<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="text" class="form-control bookingDate dateBooked" 
                                       onclick="hideTable()" value="<?php echo date('Y-m-d'); ?>"
                                       name="bookingDate" id="dateBooked"
                                       placeholder="DD-MM-YYYY" onfocus="(this.type = 'date')" required="">
                            </div>
                        </div>
                        <!--                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="validatedCustomFile" class="col-form-label font-weight-bold">Upload Image: </label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="file" id="validatedCustomFile" >
                                                        <label class="custom-file-label" for="validatedCustomFile">Choose File...</label>
                                                    </div>
                                                </div>-->
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_service_type" class="col-form-label font-weight-bold">Recipient's Address:<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <select class="form-control txt_service_type" id="txt_service_type" name="txt_service_type" required="">
                                    <option value="">Service Type</option>
                                    <option value="Air">Air</option>
                                    <option value="Document">Document</option>
                                    <option value="Ground">Ground</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3 ">
                        <input type="submit" onclick="getTimeAndDate();hideTable();" class="btn btn-secondary mt-2 font-weight-bold" value="Submit" />
                        <!--<input type="reset" onclick="hideTable()" class="btn btn-secondary mt-2 font-weight-bold" value="Reset" />-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- View Modal -->
<div class="modal fade" id="viewCourierPackage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">View Courier Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="code/u-ajaxRequest.php?action=viewCourierPackage" 
                      method="post" 
                      id="book-courier-package-form"
                      enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <input type="hidden" class="form-control" id="int_courier_booking_id" name="int_courier_booking_id" 
                                    readonly="" aria-describedby="int_courier_booking_id" required="true">
                            <label for="txt_sender_name" class="col-form-label font-weight-bold">Sender's Name<sup class="text-danger font-weight-bold">*</sup>: </label>
                            <div class="">
                                <input type="text" class="form-control senderName" id="senderName" name="txt_sender_name" 
                                        readonly="" value="<?= $_SESSION['name'] ?>"
                                       aria-describedby="txt_sender_name_help" placeholder="Sender Name" required="true">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_sender_number" class="col-form-label font-weight-bold">Sender's Mobile<sup class="text-danger font-weight-bold">*</sup>: </label>
                            <div class="">
                                <input type="number" class="form-control senderNumber" id="senderNumber" name="txt_sender_number" 
                                        readonly="" value="<?= $_SESSION['number'] ?>"
                                       aria-describedby="txt_sender_number_help" placeholder="Sender Number" required="true">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_sender_email" class="col-form-label font-weight-bold">Sender's Email: </label>
                            <div class="">
                                <input type="email" class="form-control senderEmail" id="senderEmail" name="txt_sender_email" 
                                        readonly="" value="<?= $_SESSION['email'] ?>"
                                       aria-describedby="txt_sender_email_help" placeholder="Sender Email">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_sender_address_line1" class="col-form-label font-weight-bold">Sender's Address: </label>
                            <div class="">
                                <input type="text" class="form-control senderAddressLine1" id="senderAddressLine1" name="txt_sender_address_line1" 
                                        readonly="" 
                                       aria-describedby="txt_sender_address_line1_help" placeholder="H.N., Street">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="from" class="col-form-label font-weight-bold">Origin<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="text" autocomplete="off" class="form-control from origin" onclick="hideTable()" 
                                       readonly=""
                                       onkeyup="getFromAddressData(this.value);trimTheInput(this.value)"  name="from" id="origin"
                                        readonly="" placeholder="Enter Location or Pincode" required="">
                                <div class="from-box" id="from-box" style="display: none;"></div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_courier_item" class="col-form-label font-weight-bold">Item<sup class="text-danger font-weight-bold">*</sup>: </label>
                            <div class="">
                                <input type="text" class="form-control courierItem" id="courierItem" name="txt_courier_item" 
                                        readonly="" aria-describedby="txt_courier_item" placeholder="Courier Item" required="true">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_courier_item_pieces" class="col-form-label font-weight-bold">Pieces: </label>
                            <div class="">
                                <input type="number" class="form-control courierItemPieces" id="courierItemPieces" name="txt_courier_item_pieces" 
                                        readonly="" aria-describedby="txt_courier_item_pieces" placeholder="Courier Item Pieces" >
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="weight" class="col-form-label font-weight-bold weight">Weight (in kgs)<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="number" class="form-control courierWeight" onclick="hideTable()" name="weight" id="courierWeight"
                                        readonly="" placeholder="kgs" required="" >
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_recipient_name" class="col-form-label font-weight-bold">Recipient's Name<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="text" class="form-control recipientName" id="recipientName" name="txt_recipient_name" 
                                        readonly="" aria-describedby="txt_recipient_name" placeholder="Recipient Name" required="true">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_recipient_number" class="col-form-label font-weight-bold">Recipient's Mobile<sup class="text-danger font-weight-bold">*</sup>: </label>
                            <div class="">
                                <input type="number" class="form-control recipientNumber" id="recipientNumber" name="txt_recipient_number" 
                                        readonly="" aria-describedby="txt_recipient_number" placeholder="Recipient Number" required="true">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_recipient_alternate_number" class="col-form-label font-weight-bold">Alternate Mobile: </label>
                            <div class="">
                                <input type="number" class="form-control recipientAlternativeNumber" id="recipientAlternativeNumber" name="txt_recipient_alternate_number" 
                                        readonly="" aria-describedby="txt_recipient_alternate_number" placeholder="Recipient Alternate Number" >
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_recipient_email" class="col-form-label font-weight-bold">Recipient's Email: </label>
                            <div class="">
                                <input type="email" class="form-control recipientEmail" id="recipientEmail" name="txt_recipient_email" 
                                        readonly="" aria-describedby="txt_recipient_email" placeholder="Recipient Email">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_recipient_address_line1" class="col-form-label font-weight-bold">Recipient's Address:<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="text" class="form-control recipientAddressLine1" id="recipientAddressLine1" name="txt_recipient_address_line1" 
                                       aria-describedby="txt_recipient_address_line1_help" 
                                        readonly="" placeholder="H.N., Street" required="">
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="to" class="font-weight-bold">Destination<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="text" autocomplete="off" class="form-control to destination" onclick="hideTable()" 
                                       readonly="" 
                                       onkeyup="getToAddressData(this.value)" name="to" id="destination" readonly="" 
                                       placeholder="Enter a Location or Pincode" required="">
                                <div class="to-box" id="to-box" style="display: none;"></div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="bookingDate" class="font-weight-bold">Pick Up Date<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <input type="text" class="form-control bookingDate dateBooked" 
                                       onclick="hideTable()" value="<?php echo date('Y-m-d'); ?>"
                                       name="bookingDate" id="dateBooked" readonly="" 
                                       placeholder="DD-MM-YYYY" onfocus="(this.type = 'date')" required="">
                            </div>
                        </div>
                        <!--                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="validatedCustomFile" class="col-form-label font-weight-bold">Upload Image: </label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="file" id="validatedCustomFile" >
                                                        <label class="custom-file-label" for="validatedCustomFile">Choose File...</label>
                                                    </div>
                                                </div>-->
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_service_type" class="col-form-label font-weight-bold">Recipient's Address:<sup class="text-danger">*</sup>: </label>
                            <div class="">
                                <select class="form-control txt_service_type" readonly="" disabled="" id="txt_service_type" name="txt_service_type" required="">
                                    <option value="">Service Type</option>
                                    <option value="Air">Air</option>
                                    <option value="Document">Document</option>
                                    <option value="Ground">Ground</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3 ">
<!--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>-->
                </button>
                        <input type="button" data-dismiss="modal"
                               class="btn btn-secondary mt-2 font-weight-bold" value="Close" />
                        <!--<input type="reset" onclick="hideTable()" class="btn btn-secondary mt-2 font-weight-bold" value="Reset" />-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

