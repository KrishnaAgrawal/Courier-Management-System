<!DOCTYPE html>
<?php
include_once './constants.php';
$location = '';
if (!empty($arrPost = $_POST)) {
    if (!empty($arrPost['call-us'])) {
        $location = $arrPost['location'];
        include_once './code/ajaxRequest.php';
        include_once './code/Utilities.php';
        $result = getResultAddressOfGivenLoaction($arrPost);
//        echo '<pre>';print_r($result->fetch_array());exit;
    }
//        echo '<pre>';print_r($location);exit;
}
?>
<html>
    <head>

        <title></title>
        <?php include_once './linksAndScripts.php'; ?>
        <link href="css/index.css" rel="stylesheet" type="text/css"/>
        <style>
            html{
                scroll-behavior: smooth;
            }
            .animation{
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
            .bg-green{
                background: lightgreen;
                font-weight: bold;
            }
        </style>
        <script>

            function checkBlank() {
                location = $("#location").val();
                if (location.length > 0 && location.length != 0) {
//                    beforeSend: function(){
                    // Show image container
//                                $(".handle-spinner").show();
//                               },
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
            function getFromAddressData(location) {
                $("#location").val(trimTheInput(location));
                $.ajax({
                    url: "code/ajaxRequest.php?action=from",
                    type: 'POST',
//                    dataType: 'JSON',
                    data: {from: location},
                    beforeSend: function () {
                        // Show image container
//                        $(".handle-spinner").show();
                    },
                    success: function (result) {
                        $("#location-box").show();
                        $("#location-box").html(result);
                        $("#location").css("background", "#FFF");
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
                $("#location").val(val);
                $("#location-box").hide();
            }

            /*
             * trim function value
             */
            function trimTheInput(text) {
                return text.replace(/ +(?= )/g, '');
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
        <div class="container-fluid">
            <?php include_once './header.php'; ?>
            <div class="container-fluid">
                <?php include_once './carousel.php'; ?>
                <div class="row mt-4" id="top">
                    <div class="col-12 mb-4">
                        <h3 class="font-weight-bold text-center mb-4">Write To Us</h3>
                        <div class="container text-secondary">
                            <?php
                                if(!empty($_GET) && !empty($query = $_GET['q'])){
                                    if($query == "save" && !empty($name = $_GET['n'])){
                                        $str = "<strong>Dear $name,</strong> your data has been submitted.";
                                        $color = "info";
                                    } else if($query == "error"){
                                        $str = "Someting went wrong. Please try again later.";
                                        $color = "danger";
                                    }
                            ?>
                            <div class="alert alert-<?=$color?> alert-dismissible fade show" role="alert">
                                <?=$str?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                                }
                            ?>
                            <div class="card">
                                <div class="card-header bg-secondary text-center">
                                    <span class="text-white font-weight-bold" >Contact Number: 
                                        <a href="<?= MOBILE_LINK ?>" class="text-white text-decoration"><?= MOBILE ?></a>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <form action="code/ajaxRequest.php?action=write-to-us" method="post">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputNamel4" class="font-weight-bold text-dark">Name<sup class="text-danger">*</sup></label>
                                                <input type="text" class="form-control" name="name" id="inputNamel4" placeholder="Enter Name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4" class="font-weight-bold text-dark">Email<sup class="text-danger"></sup></label>
                                                <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Enter Email">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputNumber4" class="font-weight-bold text-dark">Number<sup class="text-danger">*</sup></label>
                                                <input type="number" class="form-control" name="number" id="inputNumber4" placeholder="Enter Password">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputCity4" class="font-weight-bold text-dark">City<sup class="text-danger">*</sup></label>
                                                <input type="text" class="form-control" name="city" id="inputCity4" placeholder="Enter City">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputNumber4" class="font-weight-bold text-dark">You Are<sup class="text-danger">*</sup></label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="you-are">
                                                    <option value="">Select</option>
                                                    <option value="You Sent The Shipment">You Sent The Shipment</option>
                                                    <option value="You Are A Reciever">You Are A Reciever</option>
                                                    <option value="You Not Wish To be Indentified">You Not Wish To be Indentified</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputSubject4" class="font-weight-bold text-dark">Subject<sup class="text-danger">*</sup></label>
                                                <input type="text" class="form-control" name="subject" id="inputSubject4" placeholder="Enter Subject">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1" class="font-weight-bold text-dark">Description<sup class="text-danger">*</sup></label>
                                            <textarea class="form-control" 
                                                      id="exampleFormControlTextarea1" name="textarea" rows="3" placeholder="Enter Description"></textarea>
                                        </div>
                                        <!--<i class="requiredFields"><sup class="text-danger font-weight-bold">*</sup>Indicates required fields.</i>-->
                                        <!--<br />-->
                                        <input type="submit" name="call-us" onclick="hideTable();" class="btn btn-success mb-2" value="Save" />
                                        <input type="reset" onclick="hideTable()" class="btn btn-success mb-2" value="Reset" />
                                    </form>
                                    <?php
                                    include_once './goToTop.php';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <?php
                include_once './goToTop.php';
                include_once './address&imp-link.php';
                ?>

        </div>
    </body>
</html>