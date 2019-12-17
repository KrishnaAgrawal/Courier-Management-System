<!DOCTYPE html>
        <?php 
        include_once './constants.php';
        ?>
<html>
    <head>
        
        <title></title>
        <?php include_once './linksAndScripts.php'; ?>
        <link href="css/index.css" rel="stylesheet" type="text/css"/>
        <style>

        </style>
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
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 btn size mb-4">
                        <a class="text-dark" href="location-finder.php">
                        <button class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-secondary size">
                            <span class="fa fa-globe"> Location Finder</span>
                        </button>
                            </a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 btn size">
                        <a class="text-dark" href="find-time&price.php">
                        <button class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-secondary size">
                            <span class="fa fa-clock"> Transit Time & Price Finder</span>
                        </button>
                            </a>
                    </div>
                </div>
                <?php include_once './address&imp-link.php'; ?>
            </div>
            
        </div>
    </body>
</html>
