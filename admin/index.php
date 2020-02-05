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
            function getHits(){
                var startDateHits = $(".startDateHits").val();
                var endDateHits = $(".endDateHits").val();
                if(startDateHits < endDateHits){
                    $.ajax({
                        method: 'post',
                        url: "code/ajaxRequests.php?action=getHits",
                        data: {startDateHits: startDateHits, endDateHits: endDateHits},
                        success: function (response){
                            if($.isNumeric(response)){
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
            function getUsers(){
                var startDateUsers = $(".startDateUsers").val();
                var endDateUsers = $(".endDateUsers").val();
                if(startDateUsers < endDateUsers){
                    $.ajax({
                        method: 'post',
                        url: "code/ajaxRequests.php?action=getUsers",
                        data: {startDateUsers: startDateUsers, endDateUsers: endDateUsers},
                        success: function (response){
                            if($.isNumeric(response)){
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
            function updateCustomerDetail(custId){
                var customerName =  $("#cust_name-"+custId).text();
                var customerNumber =  $("#cust_number-"+custId).text();
                var customerEmail =  $("#cust_email-"+custId).text();
                var customerAddress =  $("#cust_address-"+custId).text();
                var customerCity =  $("#cust_city-"+custId).text();
                var customerState =  $("#cust_state-"+custId).text();
                $.ajax({
                    url: "code/ajaxRequests.php?action=updateCustomerDetail",
                    type: 'POST',
                    data: {custId: custId, customerNumber: customerNumber, customerName: customerName, customerEmail: customerEmail, customerAddress: customerAddress, customerCity: customerCity, customerState: customerState},
                    success: function(result){
                        if(result == "SUCCESS"){
                            $('.table-body').each(function () {
                                $('.table-body').removeClass("tr-text-success");
                            });
                            $(".mark-row-" + custId).addClass("tr-text-success");
                        } else if(result == "ERROR"){
                            alert(result);
                        }
                    },
                    statusCode: {
                        404: function() {
                            alert( "Something went wrong" );
                        }
                    }
                });
            }
            
            /*
             * AJAX for delete the product type deatil
             */
            function deleteCustomerDetail(customerId){
                var res = confirm("Are you sure to delete this item?");
                if(res){
                    $.ajax({
                       url: "code/ajaxRequests.php?action=deleteCustomerDetail",
                       type: 'POST',
                       data: {customerId: customerId},
                       success: function(result){
//                           alert(result);
                           if(result == "SUCCESS"){
                               $(".mark-row-" + customerId).attr("hidden", true);
                           } else if(result == "ERROR"){
                               alert(result);
                           }
                       },
                       statusCode: {
                           404: function() {
                               alert( "Something went wrong" );
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
        <div class="container-fluid bg-light">
            <?php
            include_once './adminHeader.php';
            include_once '../code/Utilities.php';
            $utilities = new Utilities();
            include_once '../constants.php';
            $users = 0;
            $hits = 0;
            $query = "SELECT count(ip_address) as users, sum(hits) as hits FROM user_hits";
            if ($result = $utilities->selectQuery($query)) {
                if ($result->num_rows > 0) {
                    if ($rows = $result->fetch_array()) {
                        $users = $rows['users'];
                        $hits = $rows['hits'];
                    }
                }
            }
            ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-3">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <form>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 my-1">
                                        <label class="text-white font-weight-bold" for="start_date_hits">Start Date </label>
                                        <input type="date" class="form-control startDateHits" name="start_date_hits" placeholder="" />
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 my-1">
                                        <label class="text-white font-weight-bold" for="end_date_hits">End Date </label>
                                        <input type="date" class="form-control endDateHits" name="end_date_hits" placeholder="" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col mt-1 mx-auto">
                                        <label class="text-white font-weight-bold" for=""> &nbsp;</label>
                                        <input type="button" onclick="getHits()" class="form-control font-weight-bold" name="hitsSubmit" value="Submit" />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body bg-light text-center">
                            <span class="text-secondary">
                                <span class=" font-weight-bold font-size setHitsData"> <?= $hits ?></span>
                                <span class="h2-font-size font-weight-bold"> Hits</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 my-3">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <form>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 my-1">
                                        <label class="text-white font-weight-bold" for="start_date_user">Start Date </label>
                                        <input type="date" class="form-control startDateUsers" name="start_date_user" placeholder="" />
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 my-1">
                                        <label class="text-white font-weight-bold" for="start_date_user">End Date </label>
                                        <input type="date" class="form-control endDateUsers" name="end_date_user" placeholder="" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col mt-1 mx-auto">
                                        <label class="text-white font-weight-bold" for="start_date_hits">  &nbsp;</label>
                                        <input type="button" onclick="getUsers()" class="form-control font-weight-bold" name="userSubmit" value="Submit" />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body bg-light text-center">
                            <span class="text-secondary">
                                <span class=" font-weight-bold font-size setUsersData"> <?= $users ?></span>
                                <span class="h2-font-size font-weight-bold"> Users</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
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
            </div>
            <div class="col-sm-12 my-3" id="user">
                <div class="separator">
                    <h4 class="ask font-weight-bold fa-2x"> Employee Details </h4>
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
            $queryCount = "SELECT count(*) FROM tbl_registration WHERE ysn_deleted=0";
            if ($result = $utilities->selectQuery($queryCount)) {
                if ($rows = $result->fetch_array()) {
                    $totalCustomerCount = $rows['0'];
                }
            }

            ?>
            <div class="row mb-2 mt-5">
                <div class="col">
                    <button class="btn btn-lg btn-secondary text-white  font-weight-bold"
                            style="cursor: text;"
                            title='Total Products <?=$totalCustomerCount?>'>
                        <i class="fas fa-users"></i> &nbsp;
                        <?=$totalCustomerCount?>
                    </button>
                </div>
                <div class="col">
                    <a href="#" <?=$adminType?> class="btn btn-lg float-right btn-secondary"
                       style="cursor: pointer;" title="dfsdfd" data-toggle="modal" data-target="#customerModal">
                        <i class="fas fa-plus-square"></i>
                    </a>
                </div>
            </div>
            <div class="row">
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
                        $query = "SELECT * FROM tbl_registration WHERE ysn_deleted=0 ORDER BY txt_name LIMIT $startingIndex, $pageLimit";
//                        echo $query;exit;
                        if ($result = $utilities->selectQuery($query)) {
                                ?>
                            <tr class="bg-secondary text-white">
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Number</th>
                                <th>Email</th>
                                <th>Street</th>
                                <th>City</th>
                                <th>State</th>
                                <th <?=$adminType?>>Action</th>
                            </tr>
                        <?php
                            while ($rows = $result->fetch_array()) {
//                                echo '<pre>';print_r($rows);exit;
                                ?>
                                <tr class="table-body mark-row-<?= $rows['0'] ?>">
                                    <td><?= ++$startingIndex; ?></td>
                                    <td class="txt_name-<?= $rows['0'] ?>" 
                                        contenteditable="true" 
                                        id="cust_name-<?= $rows['0'] ?>" 
                                        name="txt_name-<?= $rows['0'] ?>"><?= $rows['txt_name'] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        contenteditable="true" 
                                        id="cust_number-<?= $rows['0'] ?>"
                                        name="txt_number-<?= $rows['0'] ?>"><?= $rows['txt_number'] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        contenteditable="true" 
                                        id="cust_email-<?= $rows['0'] ?>"
                                        name="txt_email-<?= $rows['0'] ?>"><?= $rows['txt_email'] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        contenteditable="true" 
                                        id="cust_address-<?= $rows['0'] ?>"
                                        name="txt_address-<?= $rows['0'] ?>"><?= $rows['txt_address'] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        contenteditable="true" 
                                        id="cust_city-<?= $rows['0'] ?>"
                                        name="txt_city-<?= $rows['0'] ?>"><?= $rows['txt_city'] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        contenteditable="true" 
                                        id="cust_state-<?= $rows['0'] ?>"
                                        name="txt_state-<?= $rows['0'] ?>"><?= $rows['txt_state'] ?></td>
                                    <td <?=$adminType?> >
                                        <a onclick="updateCustomerDetail(<?= $rows['0'] ?>)" 
                                           class="text-dark" 
                                           style="cursor: pointer;"
                                           title="Modify">
                                            <span class="fas fa-check-circle"></span>
                                        </a>
                                        &nbsp;
                                        <a onclick="deleteCustomerDetail(<?= $rows['0'] ?>)" 
                                           class="text-dark" 
                                           style="cursor: pointer;"
                                           title="Delete">
                                            <span class="fas fa-trash"></span>
                                        </a>
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
                    <?php include_once '../goToTop.php';?>
                </div>
            </div>
            <div class="row mt-2 mb-4">
                <div class="col">
                    <button class="btn btn-lg btn-secondary text-white font-weight-bold"
                            style="cursor: text;"
                            title='Total Products <?=$totalCustomerCount?>'>
                        <i class="fas fa-users"></i> &nbsp;
                        <?=$totalCustomerCount?>
                    </button>
                </div>
            </div>
        </div>
        <?php include_once 'adminFooter.php'; ?>
    </body>
</html>
