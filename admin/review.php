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
             * get-booked-courier-data
             */
            function getReviewData() {
                $(document).on("click", ".data-edit", function () {
                    var feeddbackId = $(this).attr("id");
                    $.ajax({
                        url: 'code/ajaxRequests.php?action=get-review',
                        method: 'POST',
                        data: {feeddbackId: feeddbackId},
                        dataType: 'json',
                        success: function (data) {
                            $('#int_review_id').val(data.int_review_id);
                            $('.txt_name').val(data.txt_name);
                            $('.txt_number').val(data.txt_number);
                            $('.txt_email').val(data.txt_email);
                            stars = data.tinyint_review;
                            $('.tinyint_review').val(stars);
                            for(i = 1; i <= 5; i++){
                                if(i <= stars){
                                    $("#star"+i+"Update").removeClass("far ");
                                    $("#star"+i+"Update").addClass("fa text-warning");
                                }
                            }
                            $('.txt_review').val(data.txt_review);
                            $('#updateReview').modal('show');
                        }
                    });
                });
            }
            
            /*
             * get-booked-courier-data
             */
            function getReviewDataInView() {
                $(document).on("click", ".data-view", function () {
                    var feeddbackId = $(this).attr("id");
                    $.ajax({
                        url: 'code/ajaxRequests.php?action=get-review',
                        method: 'POST',
                        data: {feeddbackId: feeddbackId},
                        dataType: 'json',
                        success: function (data) {
                            $('#reviewIdView').val(data.int_review_id);
                            $('#nameView').val(data.txt_name);
                            $('#numberView').val(data.txt_number);
                            $('#emailView').val(data.txt_email);
                            stars = data.tinyint_review;
                            for(i = 1; i <= 5; i++){
                                if(i <= stars){
                                    $("#star"+i+"View").removeClass("far ");
                                    $("#star"+i+"View").addClass("fa text-warning");
                                }
                            }
                            $('#reviewView').val(data.txt_review);
                            $('#viewReview').modal('show');
                        }
                    });
                });
            }

            /*
             * get-booked-courier-data
             */
            function deleteReviewData(reviewId) {
                var res = confirm("Are you sure to delete this item?");
                if(res){
                    window.location.href = "code/ajaxRequests.php?action=deleteReview&reviewId="+reviewId;
                }
            }
            
            /*
             * get Star
             */
            function getStar(stars){
                for(i = 1; i <= 5; i++){
                    if(i <= stars){
                        $("#star"+i).addClass("fa text-warning");
                    } else {
                        $("#star"+i).removeClass("fa text-warning");
                        $("#star"+i).addClass("far ");
                    }
                }
                $("#tinyint_review").val(stars);
            }
            
            /*
             * get Star
             */
            function getStarUpdate(stars){
                for(i = 1; i <= 5; i++){
                    if(i <= stars){
                        $("#star"+i+"Update").addClass("fa text-warning");
                    } else {
                        $("#star"+i+"Update").removeClass("fa text-warning");
                        $("#star"+i+"Update").addClass("far ");
                    }
                }
                $("#update_tinyint_review").val(stars);
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
                    $errorDetail = "Approved & Updated Successfully.";
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
                        <h4 class="ask font-weight-bold fa-2x text-center">Review</h4>
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
            $queryCount = "SELECT count(*) FROM tbl_review WHERE ysn_deleted=0";
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
<!--                <div class="col">
                    <a href="#" <?= $adminType ?> class="btn btn-lg float-right btn-secondary"
                       style="cursor: pointer;" title="dfsdfd" data-toggle="modal" data-target="#bookCourierPackage">
                        <i class="fas fa-plus-square"></i>
                    </a>
                </div>-->
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
                        $query = "SELECT * FROM tbl_review WHERE ysn_deleted=0 LIMIT $startingIndex, $pageLimit";
//                        echo $query;exit;
                        if ($result = $utilities->selectQuery($query)) {
                            ?>
                            <tr class="bg-secondary text-white">
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Number</th>
                                <th>Email</th>
                                <th>Ratings</th>
                                <th>Review</th>
                                <th <?= $adminType ?>>Action</th>
                            </tr>
                            <?php
                            while ($rows = $result->fetch_array()) {
//                                echo '<pre>';print_r($rows);exit;
                                $txtColorGreen = "badge-danger";
                                $txtTitle = "Not Reviewed";
                                if($rows['ysn_approved'] == 1){
                                    $txtTitle = "Reviewed";
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
                                        name="txt_name-<?= $rows['0'] ?>"><?= $rows['txt_name'] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        id="cust_number-<?= $rows['0'] ?>"
                                        name="txt_number-<?= $rows['0'] ?>"><?= $rows['txt_number'] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        id="cust_email-<?= $rows['0'] ?>"
                                        name="txt_email-<?= $rows['0'] ?>"><?= $rows['txt_email'] ?></td>
                                    <td class="txt_short_name-<?= $rows['0'] ?> font-weight-bold" 
                                        id="cust_city-<?= $rows['0'] ?>"
                                        name="txt_city-<?= $rows['0'] ?>">
                                        <?php
                                        for($i = 1; $i <= $rows['tinyint_review']; $i++){
                                            echo '<i class="fa fa-star text-warning"></i>';
                                        }
                                        ?>
                                    </td>
                                    <td class="txt_short_name-<?= $rows['0'] ?>" 
                                        id="cust_city-<?= $rows['0'] ?>"
                                        name="txt_city-<?= $rows['0'] ?>"><?= $rows['txt_review'] ?></td>
                                    <td <?= $adminType ?> >
<!--                                        <a 
                                            class="text-dark data-view" 
                                            onclick="getReviewDataInView()"
                                            id='<?= $rows['int_review_id'] ?>'
                                            style="cursor: pointer;"
                                            title="View">
                                            <span class="fas fa-eye"></span>
                                        </a>
                                        &nbsp;-->
                                        <a 
                                            class="text-dark data-edit" 
                                            onclick="getReviewData()"
                                            id='<?= $rows['int_review_id'] ?>'
                                            style="cursor: pointer;"
                                            title="Approve & Update">
                                            <span class="fas fa-edit"></span>
                                        </a>
                                        <!--&nbsp;-->
                                        <a onclick="deleteReviewData(<?= $rows['0'] ?>)" 
                                           class="text-dark data-delete" 
                                           style="cursor: pointer;"
                                           title="Move to trash">
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
        <?php include_once 'adminFooter.php'; ?>
    </body>
</html>


<!-- Update Modal -->
<div class="modal fade" id="updateReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Approve & Update Courier Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="code/ajaxRequests.php?action=updateReview" 
                      method="post" 
                      id="book-courier-package-form"
                      enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <input type="hidden" class="form-control" id="int_review_id" name="int_review_id" 
                                    aria-describedby="int_review_id" required="true">
                            <label for="txt_name" class="col-form-label font-weight-bold">Name<sup class="text-danger font-weight-bold">*</sup>: </label>
                            <div class="">
                                <input type="text" class="form-control txt_name" id="txt_name" name="txt_name" readonly="" 
                                       aria-describedby="txt_name_help" placeholder="Name" required="true">
                            </div>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_number" class="col-form-label font-weight-bold">Mobile: </label>
                            <div class="">
                                <input type="number" class="form-control txt_number" id="txt_number" readonly="" 
                                       name="txt_number"
                                       aria-describedby="txt_number_help" placeholder="Number">
                            </div>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label for="txt_email" class="col-form-label font-weight-bold">Email: </label>
                            <div class="">
                                <input type="email" class="form-control txt_email" id="txt_email" name="txt_email" 
                                       aria-describedby="txt_email_help" placeholder="Email" readonly="" >
                            </div>
                        </div>
                        <div class="form-row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="tinyint_review" class="col-form-label font-weight-bold mr-2">
                                Ratings<sup class="text-danger font-weight-bold">*</sup>: </label>
                            <div class="mt-1">
                                <i class="far fa-star fa-2x star1" id="star1Update" value="1"></i>
                                <i class="far fa-star fa-2x star2" id="star2Update" value="2"></i>
                                <i class="far fa-star fa-2x star3" id="star3Update" value="3"></i>
                                <i class="far fa-star fa-2x star4" id="star4Update" value="4"></i>
                                <i class="far fa-star fa-2x star5" id="star5Update" value="5"></i>
                                <input type="hidden" name="tinyint_review" class="form-control tinyint_review"
                                       id="update_tinyint_review" />
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="txt_email" class="col-form-label font-weight-bold">Review<sup class="text-danger font-weight-bold">*</sup>: </label>
                            <div class="">
                                <textarea class="form-control txt_review" id="txt_review" 
                                          name="txt_review" rows="3" readonly=""  required=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3 ">
                        <input type="submit" class="btn btn-secondary mt-2 font-weight-bold" value="Submit" />
                        <br />
                        <small class="text-success font-weight-bold">Approve & Update</small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
