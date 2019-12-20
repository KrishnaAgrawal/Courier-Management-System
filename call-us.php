<!DOCTYPE html>
        <?php 
        include_once './constants.php';
        if(!empty($arrPost = $_POST)){
            if(!empty($arrPost['Find'])){
                include_once './code/ajaxRequest.php';
                include_once './code/Utilities.php';
                $result = getResultAddressOfGivenLoaction($arrPost);
            }
        //    echo '<pre>';print_r($result);exit;
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
            .bg-green{
                background: lightgreen;
                font-weight: bold;
            }
        </style>
        <script>
            
            function checkBlank(){
                location = $("#location").val();
                if (location.length > 0 && location.length != 0){    
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
            function getFromAddressData(location){
                $("#location").val(trimTheInput(location));
                $.ajax({
                    url: "code/ajaxRequest.php?action=from",
                    type: 'POST',
//                    dataType: 'JSON',
                    data: {from: location},
                    beforeSend: function(){
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
                $("#location").val(val);
                $("#location-box").hide();
            }
            
            /*
             * trim function value
             */
            function trimTheInput(text){
                return text.replace(/ +(?= )/g,'');
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
            <?php include_once './header.php';?>
            <div class="container-fluid">
                <div class="carouselSize">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/package1.jpg" class="d-block w-100 img-fluid" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h3 class="text-dark">Proof of Delivery</h3>
                                <p class="text-dark">Track Delivery of your Courier and Get Delivery Reports online.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/delivery.jpg" class="d-block w-100 img-fluid" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h3 class="text-light"></h3>
                                <!--<p class="text-warning"></p>-->
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/ways.jpg" class="d-block w-100 img-fluid" alt="...">
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
                    <div class="col-12 mb-4">
                        <h3 class="font-weight-bold text-center mb-4">Call Us</h3>
                        <div class="container text-secondary">
                            <div class="card">
                                <div class="card-header bg-secondary">
                                    <span class="text-white font-weight-bold" >Contact Number: 
                                        <a href="<?=MOBILE_LINK?>" class="text-white "><?=MOBILE?></a>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <form action="location-finder.php" method="post">
                                        <div class="form-row">
                                            <div class="form-group col-md-6 autocomplete">
                                                <label for="location" class="font-weight-bold">Location<sup class="text-danger">*</sup></label>
                                                <input type="text" class="form-control" onclick="hideTable()" autocomplete="off"
                                                       onkeyup="getFromAddressData(this.value);trimTheInput(this.value)"  name="location" id="location"
                                                       required=""
                                                       placeholder="Enter a Location or Pincode">
                                                <div id="location-box" style="display: none;"></div>
                                            </div>
                                        </div>
                                        <i class="requiredFields"><sup class="text-danger font-weight-bold">*</sup>Indicates required fields.</i>
                                        <br />
                                        <input type="submit" name="Find" onclick="hideTable();" class="btn btn-success mt-2" value="Find" />
                                        <input type="reset" onclick="hideTable()" class="btn btn-success mt-2" value="Reset" />
                                    </form>
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
            
        </div>
    </body>
</html>
