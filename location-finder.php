<!DOCTYPE html>
<?php
include_once './constants.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php include_once './linksAndScripts.php'; ?>
        <link href="css/index.css" rel="stylesheet" type="text/css"/>
        <style>
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
        </style>
        <script>
            function checkBlank(){
                from = $("#from").val();
                if (from.length > 0 && from.length != 0){    
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
            function hideTable(){
                $(".table-data-content").attr("hidden", "");
                
            }
            
            /*
             * getAddressData()
             */
            function getFromAddressData(from){
                $("#from").val(trimTheInput(from));
                $.ajax({
                    url: "code/ajaxRequest.php?action=from",
                    type: 'POST',
//                    dataType: 'JSON',
                    data: {from: from},
                    beforeSend: function(){
                        // Show image container
//                        $(".handle-spinner").show();
                       },
                    success: function (result) {
                        $("#from-box").show();
                        $("#from-box").html(result);
                        $("#from").css("background", "#FFF");
                        if (result == "ERROR") {
                        }
                    },
                    complete:function(result){
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
            
            /*
             * trim function value
             */
            function trimTheInput(text){
                return text.replace(/ +(?= )/g,'');
            }
        </script>
    </head>
     <!--onload="hideTable()"-->
    <body class="bg-light" oncontextmenu="return false;">
        <noscript>
        <meta HTTP-EQUIV="refresh" content=0;url="javascriptNotEnabled.html">
        <style type="text/css">
            .container-fluid { display:none; }
        </style>
        </noscript>
        <div class="container-fluid">
            <?php include_once './header.php'; ?>
            <div class="bd-example">
                <div class="carouselSize">
                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="img/package1.jpg" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3 class="text-dark">Proof of Delivery</h3>
                                    <p class="text-dark">Track Delivery of your Courier and Get Delivery Reports online.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="img/delivery.jpg" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3 class="text-light"></h3>
                                    <!--<p class="text-warning"></p>-->
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="img/ways.jpg" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3 class="text-light">Gets courier delivered anywhere in India the very-next-day.</h3>
                                    <p class="text-light"></p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only ">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
                        <h3 class="font-weight-bold text-center">Find your Serviceable Area</h3>
                    </div>
                </div>
                <div class="container">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6 autocomplete">
                                <label for="from" class="font-weight-bold">Location<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" onclick="hideTable()" 
                                       onBlur="$('#from-box').hide();"
                                       onkeyup="getFromAddressData(this.value);trimTheInput(this.value)"  name="from" id="from"
                                       placeholder="Enter a Location or Pincode">
                                <div id="from-box" style="display: none;"></div>
                            </div>
                        </div>
                        <i class="requiredFields"><sup class="text-danger font-weight-bold">*</sup>Indicates required fields.</i>
                        <br />
                        <input type="button" onclick="checkBlank();hideTable();" class="btn btn-success mt-2" value="Find" />
                        <input type="reset" onclick="hideTable()" class="btn btn-success mt-2" value="Reset" />
                    </form>
                    <div class="text-center handle-spinner" style="display: none;">
                        <div class="spinner-border " role="status">
                            <span class="sr-only  mx-0">Loading...</span>
                        </div>
                    </div>
                    <div class="table-data-content">
                        <table class="table table-bordered table-responsive-lg my-4">
                            <tr class="text-success" style="background-color: #e9e9e9;">
                                <th colspan="2">Pincode: 273001</th>
                                <th>Services</th>
                                <th>Pickup</th>
                                <th>Delivery</th>
                            </tr>
                            <tr class="">
                                <td rowspan="2"><i class="fas fa-home"></i></td>
                                <td rowspan="2">
                                    Gorakhpur, <br />
                                    Ghaziabad, <br />
                                    UP
                                </td>
                                <th>Document</th>
                                <td class="text-center btn-lg"><span class="badge badge-success documentDelivery"></span></td>
                                <td class="text-center btn-lg"><span class="badge badge-success documentPickup"></span></td>
                            </tr>
                            <tr class="">
                                <th>Air Package</th>
                                <td class="text-center btn-lg"><span class="badge badge-success airDelivery"></span></td>
                                <td class="text-center btn-lg"><span class="badge badge-danger airPickup"></span></td>
                            </tr>
                            <tr class="">
                                <td><i class="fas fa-phone-alt"></i></td>
                                <td><?=MOBILE?></td>
                                <th>Ground</th>
                                <td class="text-center btn-lg"><span class="badge badge-success groundDelivery"></span></td>
                                <td class="text-center btn-lg"><span class="badge badge-success groundPickup"></span></td>
                            </tr>
                        </table>
                    </div>
                        <!--Horizontal line-->
                        <div class="col mt-5">
                            <div class="col border-top border-width-2 mb-4"></div>
                        </div>
                </div>
                <?php include_once './address&imp-link.php'; ?>
            </div>

        </div>
    </body>
</html>
