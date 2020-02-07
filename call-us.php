<!DOCTYPE html>
<?php
include_once './constants.php';
$location = '';
$result = [];
if (!empty($arrPost = $_POST)) {
    if (!empty($arrPost['call-us'])) {
        $location = $arrPost['location'];
        include_once './code/ajaxRequest.php';
        include_once './code/Utilities.php';
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
            include_once './code/Utilities.php';
            include_once './calc-user-hits.php'; ?>
            <div class="container-fluid">
                <?php 
                include_once './carousel.php'; 
                ?>
                <div class="row mt-4" id="top">
                    <div class="col-12 mb-4">
                        <h3 class="font-weight-bold text-center mb-4">Call Us</h3>
                        <div class="container text-secondary">
                            <div class="card">
                                <div class="card-header bg-secondary text-center">
                                    <span class="text-white font-weight-bold" >Contact Number: 
                                        <a href="<?= MOBILE_LINK ?>" class="text-white text-decoration"><?= MOBILE ?></a>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <form action="call-us.php?call-us" method="post">
                                        <div class="form-row">
                                            <div class="form-group col-md-6 autocomplete">
                                                <label for="location" class="font-weight-bold">Location<sup class="text-danger">*</sup></label>
                                                <input type="text" class="form-control" onclick="hideTable()" autocomplete="off"
                                                       onkeyup="getFromAddressData(this.value);
                                                               trimTheInput(this.value)"  name="location" id="location"
                                                       required=""
                                                       value="<?=(!empty($location)? $location : "")?>"
                                                       placeholder="Enter a Location or Pincode">
                                                <div id="location-box" style="display: none;"></div>
                                            </div>
                                        </div>
                                        <i class="requiredFields"><sup class="text-danger font-weight-bold">*</sup>Indicates required fields.</i>
                                        <br />
                                        <input type="submit" name="call-us" onclick="hideTable();" class="btn btn-success my-2" value="Get Detail" />
                                        <input type="reset" onclick="hideTable()" class="btn btn-success my-2" value="Reset" />
                                    </form>
                                    <?php
                                        include_once './goToTop.php';
                                        $totalCount = 0;
                                        $result = getResultAddressOfGivenLoaction($arrPost);
//                                        echo '<pre>';print_r($result->fetch_array());exit;
                                        if(!empty($result)){
//                                            if($result->num_rows > 0){
//                                                    echo '<pre>';print_r($result);exit;
//                                                $totalCount = $result->num_rows;
                                        ?>
                                        <?php
                                        $arrTempPincode = [];
                                                while ($rows = $result->fetch_array()){
                                                    if(empty($rows['txt_number']) || array_key_exists($rows['int_pincode'], $arrTempPincode)){
                                                        continue;
                                                    }
                                                    $arrTempPincode[$rows['int_pincode']] = $rows['int_pincode'];
                                                    ++$totalCount;
                                        ?>
                                        <!--<div class="table-data-content">-->
                                            <table class="table table-bordered table-responsive-lg mb-4">
                                                <tr class="text-success" style="background-color: #e9e9e9;">
                                                    <th colspan="2">Pincode: <?=$rows['int_pincode']?></th>
                                                    <th>Services</th>
                                                    <th>Pickup</th>
                                                    <th>Delivery</th>
                                                </tr>
                                                <tr class="">
                                                    <td rowspan="2"><i class="fas fa-home"></i></td>
                                                    <td rowspan="2">
                                                        <?=((!empty($rows['txt_sub_office']) && $rows['txt_sub_office']!="NA")? $rows['txt_sub_office'].", " : "")?> 
                                                        <?=((!empty($rows['txt_head_office']) && $rows['txt_head_office']!="NA")? $rows['txt_head_office'].",<br />" : "")?>
                                                        <?=(!empty($rows['txt_district_name'])? $rows['txt_district_name'].",<br />" : "")?> 
                                                        <?=(!empty($rows['txt_state_name'])? $rows['txt_state_name']."" : "")?>
                                                    </td>
                                                    <th>Document</th>
                                                    <td class="text-center btn-lg">
                                                        <span class="badge badge-<?=($rows['ysn_delivery']==0 ? "danger" : "success")?> documentDelivery">
                                                            <?=($rows['ysn_delivery']==0 ? "No" : "Yes")?>
                                                        </span>
                                                    </td>
                                                    <td class="text-center btn-lg">
                                                        <span class="badge badge-<?=($rows['ysn_pickup']==0 ? "danger" : "success")?> documentDelivery">
                                                            <?=($rows['ysn_pickup']==0 ? "No" : "Yes")?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <th>Air Package</th>
                                                    <td class="text-center btn-lg">
                                                        <span class="badge badge-<?=($rows['ysn_delivery']==0 ? "danger" : "success")?> documentDelivery">
                                                            <?=($rows['ysn_delivery']==0 ? "No" : "Yes")?>
                                                        </span>
                                                    </td>
                                                    <td class="text-center btn-lg">
                                                        <span class="badge badge-<?=($rows['ysn_pickup']==0 ? "danger" : "success")?> documentDelivery">
                                                            <?=($rows['ysn_pickup']==0 ? "No" : "Yes")?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td><i class="fas fa-phone-alt"></i></td>

                                                    <td><?=(!empty($rows['txt_number'])? $rows['txt_number'] : MOBILE)?></td>
                                                    <th>Ground</th>
                                                    <td class="text-center btn-lg">
                                                        <span class="badge badge-<?=($rows['ysn_delivery']==0 ? "danger" : "success")?> documentDelivery">
                                                            <?=($rows['ysn_delivery']==0 ? "No" : "Yes")?>
                                                        </span>
                                                    </td>
                                                    <td class="text-center btn-lg">
                                                        <span class="badge badge-<?=($rows['ysn_pickup']==0 ? "danger" : "success")?> documentDelivery">
                                                            <?=($rows['ysn_pickup']==0 ? "No" : "Yes")?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </table>
                                        <!--</div>-->
                                        <?php
                                                }  
                                        ?>
                                        
                                        <div class="row">
                                            <div class="col">
                                                <span class="btn btn-lg btn-info float-right">
                                                    <i class="fas fa-address-card"> <?=$totalCount?></i>
                                                </span>
                                            </div>
                                        </div>
                                        <?php
                                            }
//                                        }
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
