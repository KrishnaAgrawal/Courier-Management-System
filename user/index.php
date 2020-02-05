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
            }
        </style>
        <script>
            /*
             * get hits from ajax
             */
            function getHits() {
                var startDateHits = $(".startDateHits").val();
                var endDateHits = $(".endDateHits").val();
                if (startDateHits < endDateHits) {
                    $.ajax({
                        method: 'post',
                        url: "ajaxRequests.php?action=getHits",
                        data: {startDateHits: startDateHits, endDateHits: endDateHits},
                        success: function (response) {
                            if ($.isNumeric(response)) {
                                $(".setHitsData").text(response);
                            } else {
                                alert(response);
                            }
                        }
                    });
                } else {
                    alert("Start Date must be smaller than End Date");
                }
            }

            /*
             * get Users from ajax
             */
            function getUsers() {
                var startDateUsers = $(".startDateUsers").val();
                var endDateUsers = $(".endDateUsers").val();
                if (startDateUsers < endDateUsers) {
                    $.ajax({
                        method: 'post',
                        url: "ajaxRequests.php?action=getUsers",
                        data: {startDateUsers: startDateUsers, endDateUsers: endDateUsers},
                        success: function (response) {
                            if ($.isNumeric(response)) {
                                $(".setUsersData").text(response);
                            } else {
                                alert(response);
                            }
                        }
                    });
                } else {
                    alert("Start Date must be smaller than End Date");
                }
            }
            /*
             * AJAX for update the product group deatil
             */
            function updateCustomerDetail(custId) {
                var customerName = $("#cust_name-" + custId).text();
                var customerNumber = $("#cust_number-" + custId).text();
                var customerEmail = $("#cust_email-" + custId).text();
                var customerAddress = $("#cust_address-" + custId).text();
                var customerCity = $("#cust_city-" + custId).text();
                var customerState = $("#cust_state-" + custId).text();
                $.ajax({
                    url: "ajaxRequests.php?action=updateCustomerDetail",
                    type: 'POST',
                    data: {custId: custId, customerNumber: customerNumber, customerName: customerName, customerEmail: customerEmail, customerAddress: customerAddress, customerCity: customerCity, customerState: customerState},
                    success: function (result) {
                        if (result == "SUCCESS") {
                            $('.table-body').each(function () {
                                $('.table-body').removeClass("tr-text-success");
                            });
                            $(".mark-row-" + custId).addClass("tr-text-success");
                        } else if (result == "ERROR") {
                            alert(result);
                        }
                    },
                    statusCode: {
                        404: function () {
                            alert("Something went wrong");
                        }
                    }
                });
            }

            /*
             * AJAX for delete the product type deatil
             */
            function deleteCustomerDetail(customerId) {
                var res = confirm("Are you sure to delete this item?");
                if (res) {
                    $.ajax({
                        url: "ajaxRequests.php?action=deleteCustomerDetail",
                        type: 'POST',
                        data: {customerId: customerId},
                        success: function (result) {
//                           alert(result);
                            if (result == "SUCCESS") {
                                $(".mark-row-" + customerId).attr("hidden", true);
                            } else if (result == "ERROR") {
                                alert(result);
                            }
                        },
                        statusCode: {
                            404: function () {
                                alert("Something went wrong");
                            }
                        }
                    });
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
        <div class="container-fluid bg-white">
            <?php
            include_once './userHeader.php';
            include_once '../code/Utilities.php';
            $utilities = new Utilities();
            include_once '../constants.php';
            ?>
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 btn size mb-4">
                        <a class="text-dark" href="../location-finder.php">
                            <button class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-secondary size">
                                <span class="fa fa-globe"> Location Finder</span>
                            </button>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 btn size">
                        <a class="text-dark" href="../find-time&price.php">
                            <button class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-secondary size">
                                <span class="fa fa-clock"> Transit Time & Price Finder</span>
                            </button>
                        </a>
                    </div>
                </div>

                <?php
                $startingIndex = 0;
                $pageLimit = 10;
                if (!empty($_GET['page'])) {
                    $startingIndex = ($_GET['page'] - 1) * 10;
//                        echo '<pre>';print_r($pageLimit);
                }
                $rows['0'] = $rows['1'] = $rows['2'] = $rows['3'] = '';
                $totalCustomerCount = 0;
                $queryCount = "SELECT count(*) FROM tbl_registration WHERE ysn_deleted=0";
                if ($result = $utilities->selectQuery($queryCount)) {
                    if ($rows = $result->fetch_array()) {
                        $totalCustomerCount = $rows['0'];
                    }
                }
                ?>
                <!--            <div class="row mb-2 mt-5">
                                <div class="col">
                                    <button class="btn btn-lg btn-secondary text-white  font-weight-bold"
                                            style="cursor: text;"
                                            title='Total Products <?= $totalCustomerCount ?>'>
                                        <i class="fas fa-users"></i> &nbsp;
                <?= $totalCustomerCount ?>
                                    </button>
                                </div>
                            </div>-->
                <div class="row mt-3 mb-5" style="height: 350px;">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 btn size mb-4">
                        <div class="card border-secondary mb-3">
                            <a href="u-courier-package.php">
                                <div class="card-header bg-secondary text-white font-weight-bold">Courier Package</div>
                            </a>
                            <div class="card-body text-primary overflow-auto" style="height: 300px;">
                                <table class="m-0 table table-bordered table-striped table-responsive table-secondary text-center w-100 d-block d-lg-table">
                                    <tr class="bg-secondary text-white">
                                        <th>S.No.</th>
                                        <th style="width: 50px;">Sender</th>
                                        <th style="width: 50px;">Recipient</th>
                                        <th>Destination</th>
                                        <th title="Date of booking">D.O.B.</th>
                                        <th title="Date of delivery">D.O.D.</th>
                                    </tr>
                                    <?php
                                    $courierPackage = "SELECT txt_sender_name, txt_recipient_name, txt_destination, "
                                            . "dat_booked, dat_expected_delivery, ysn_approved FROM tbl_courier_booking WHERE "
                                            . "ysn_deleted = 0 ORDER BY dat_booked DESC LIMIT 5";
                                    if ($resCourierPackage = $utilities->selectQuery($courierPackage)) {
                                        if (!empty($resCourierPackage) && $resCourierPackage->num_rows > 0) {
                                            while ($rows = $resCourierPackage->fetch_array()) {
                                                $txtColorGreen = "badge-danger";
                                                $txtTitle = "Not Approved";
                                                if ($rows['ysn_approved'] == 1) {
                                                    $txtTitle = "Approved";
                                                    $txtColorGreen = "badge-success";
                                                }
                                                ?>
                                                <tr class="table-body">
                                                    <td class="badge <?= $txtColorGreen ?> badge-pill m-2" 
                                                        style="cursor: pointer;"
                                                        title="<?= $txtTitle ?>">
                                                        <?= ++$startingIndex; ?></td>
                                                    <td><?= $rows['txt_sender_name'] ?></td>
                                                    <td><?= $rows['txt_recipient_name'] ?></td>
                                                    <td><?= explode(" -", $rows['txt_destination'])[0] ?></td>
                                                    <td><?= $rows['dat_booked'] ?></td>
                                                    <td><?= $rows['dat_expected_delivery'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                    $startingIndex = 0;
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 btn size mb-4">
                        <div class="card border-secondary mb-3">
                            <a href="u-review.php">
                                <div class="card-header bg-secondary text-white font-weight-bold">My Reviews</div>
                            </a>
                            <div class="card-body text-primary overflow-auto" style="height: 300px;">
                                <table class="m-0 table table-bordered table-striped table-responsive table-secondary text-center w-100 d-block d-lg-table">
                                    <tr class="bg-secondary text-white">
                                        <th style="width: 10px;">S.No.</th>
                                        <th style="width: 50px;">Name</th>
                                        <th style="width: 120px;">Ratings</th>
                                        <th>Review</th>
                                    </tr>
                                    <?php
                                    $courierPackage = "SELECT txt_name, tinyint_review, txt_review, "
                                            . "ysn_approved FROM tbl_review WHERE "
                                            . "ysn_deleted = 0 ORDER BY dat_created DESC LIMIT 5";
                                    if ($resCourierPackage = $utilities->selectQuery($courierPackage)) {
                                        if (!empty($resCourierPackage) && $resCourierPackage->num_rows > 0) {
                                            while ($rows = $resCourierPackage->fetch_array()) {
                                                $txtColorGreen = "badge-danger";
                                                $txtTitle = "Not Reviewed";
                                                if ($rows['ysn_approved'] == 1) {
                                                    $txtTitle = "Reviewed";
                                                    $txtColorGreen = "badge-success";
                                                }
                                                ?>
                                                <tr class="table-body">
                                                    <td class="badge <?= $txtColorGreen ?> badge-pill mt-1" 
                                                        style="cursor: pointer;"
                                                        title="<?= $txtTitle ?>">
                                                        <?= ++$startingIndex; ?></td>
                                                    <td><?= $rows['txt_name'] ?></td>
                                                    <td>
                                                        <?php
                                                        for ($i = 1; $i <= $rows['tinyint_review']; $i++) {
                                                            echo '<i class="fa fa-star text-warning"></i>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= $rows['txt_review'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                    $startingIndex = 0;
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mb-5" style="height: 350px;">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 btn size mb-4">
                        <div class="card border-secondary mb-3">
                            <a href="u-complaint.php">
                                <div class="card-header bg-secondary text-white font-weight-bold">My Complaints</div>
                            </a>
                            <div class="card-body text-primary overflow-auto" style="height: 300px;">
                                <table class="m-0 table table-bordered table-striped table-responsive table-secondary text-center w-100 d-block d-lg-table">
                                    <tr class="bg-secondary text-white">
                                        <th>S.No.</th>
                                        <th style="width: 100px;">Name</th>
                                        <th>Complaints</th>
                                    </tr>
                                    <?php
                                    $courierPackage = "SELECT txt_name, txt_complaint, "
                                            . "ysn_approved FROM tbl_complaint WHERE "
                                            . "ysn_deleted = 0 ORDER BY dat_created DESC LIMIT 5";
                                    if ($resCourierPackage = $utilities->selectQuery($courierPackage)) {
                                        if (!empty($resCourierPackage) && $resCourierPackage->num_rows > 0) {
                                            while ($rows = $resCourierPackage->fetch_array()) {
                                                $txtColorGreen = "badge-danger";
                                                $txtTitle = "Not Reviewed";
                                                if ($rows['ysn_approved'] == 1) {
                                                    $txtTitle = "Reviewed";
                                                    $txtColorGreen = "badge-success";
                                                }
                                                ?>
                                                <tr class="table-body">
                                                    <td class="badge <?= $txtColorGreen ?> badge-pill mt-1" 
                                                        style="cursor: pointer;"
                                                        title="<?= $txtTitle ?>">
                                                        <?= ++$startingIndex; ?></td>
                                                    <td><?= $rows['txt_name'] ?></td>
                                                    <td><?= $rows['txt_complaint'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                    $startingIndex = 0;
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 btn size mb-4">
                        <div class="card border-secondary mb-3">
                            <a href="u-feedback.php">
                                <div class="card-header bg-secondary text-white font-weight-bold">My Feedback</div>
                            </a>
                            <div class="card-body text-primary overflow-auto" style="height: 300px;">
                                <table class="m-0 table table-bordered table-striped table-responsive table-secondary text-center w-100 d-block d-lg-table">
                                    <tr class="bg-secondary text-white">
                                        <th style="width: 10px;">S.No.</th>
                                        <th style="width: 50px;">Name</th>
                                        <th style="width: 120px;">Feedback</th>
                                    </tr>
                                    <?php
                                    $courierPackage = "SELECT txt_name, txt_feedback, "
                                            . "ysn_approved FROM tbl_feedback WHERE "
                                            . "ysn_deleted = 0 ORDER BY dat_created DESC LIMIT 5";
                                    if ($resCourierPackage = $utilities->selectQuery($courierPackage)) {
                                        if (!empty($resCourierPackage) && $resCourierPackage->num_rows > 0) {
                                            while ($rows = $resCourierPackage->fetch_array()) {
                                                $txtColorGreen = "badge-danger";
                                                $txtTitle = "Not Reviewed";
                                                if ($rows['ysn_approved'] == 1) {
                                                    $txtTitle = "Reviewed";
                                                    $txtColorGreen = "badge-success";
                                                }
                                                ?>
                                                <tr class="table-body">
                                                    <td class="badge <?= $txtColorGreen ?> badge-pill mt-1" 
                                                        style="cursor: pointer;"
                                                        title="<?= $txtTitle ?>">
                                                        <?= ++$startingIndex; ?></td>
                                                    <td><?= $rows['txt_name'] ?></td>
                                                    <td><?= $rows['txt_feedback'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                    $startingIndex = 0;
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once 'userFooter.php'; ?>
    </body>
</html>
