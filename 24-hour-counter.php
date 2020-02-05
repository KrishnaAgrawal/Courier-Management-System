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
            <?php include_once './header.php'; 
            include_once './calc-user-hits.php';?>
            <div class="container-fluid">
                <?php include_once './carousel.php'; ?>
                <div class="row mt-4" id="top">
                    <div class="col-12 mb-4">
                        <h3 class="font-weight-bold text-center mb-4">24 Hour Counters</h3>
                        <div class="container text-secondary">
                            <div class="card">
                                <div class="card-header bg-secondary text-center">
                                    <span class="text-white font-weight-bold" >Contact Number: 
                                        <a href="<?= MOBILE_LINK ?>" class="text-white text-decoration"><?= MOBILE ?></a>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="year-box pull-left btn btn-sm">Location: </div>
                                                </div>
                                                <div class="media-body ml-2 mb-3">
                                                    <span class="font-weight-bold "><u>VARANASI</u></span> <br />
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="year-box pull-left btn btn-sm">Address:&nbsp;</div>
                                                </div>
                                                <div class="media-body ml-2 mb-4">
                                                    <?= ADDRESS_2 ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="year-box pull-left btn btn-sm">Location: </div>
                                                </div>
                                                <div class="media-body ml-2 mb-3">
                                                    <span class="font-weight-bold "><u>GORAKHPUR</u></span> <br />
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="year-box pull-left btn btn-sm">Address:&nbsp;</div>
                                                </div>
                                                <div class="media-body ml-2 mb-4">
                                                    <?= ADDRESS_1 ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="year-box pull-left btn btn-sm">Location: </div>
                                                </div>
                                                <div class="media-body ml-2 mb-3">
                                                    <span class="font-weight-bold "><u>LUCKNOW</u></span> <br />
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="year-box pull-left btn btn-sm">Address:&nbsp;</div>
                                                </div>
                                                <div class="media-body ml-2 mb-4">
                                                    <?= ADDRESS_3 ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="year-box pull-left btn btn-sm">Location: </div>
                                                </div>
                                                <div class="media-body ml-2 mb-3">
                                                    <span class="font-weight-bold "><u>SAHAJANWA - GORAKHPUR</u></span> <br />
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="year-box pull-left btn btn-sm">Address:&nbsp;</div>
                                                </div>
                                                <div class="media-body ml-2 mb-4">
                                                    <?= ADDRESS_4 ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
