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
            html{
                scroll-behavior: smooth;
            }
            .bg-green{
                background: lightgreen;
                font-weight: bold;
            }
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
                    <div class="col-12 mb-4">
                        <h3 class="font-weight-bold text-center mb-4">Our Vision</h3>
                        <div class="container text-secondary">
                            <p>
                                "To be the best and set the pace in the express air and integrated transportation and 
                                distribution industry, with a business and human conscience.
                            </p>
                            <p>
                                We commit to develop, reward and recognise our people who, 
                                through high quality and professional service, and use of sophisticated technology, 
                                will meet and exceed customer and stakeholder expectations profitably."
                            </p>
                            <p>
                                We will continue to focus on our core domestic products to expand our market 
                                share and consolidate our unique and premium position in the Indian market. 
                                <?=COMPANY_NAME?> would also leverage its vast customer base for global distribution 
                                through its alliance with DHL. We plan to leverage our established 
                                infrastructure to continue adding value and customised solutions to the 
                                changing and evolving demands of the customer. We would also provide global 
                                logistics customers with access to our quality domestic and regional distribution. 
                                Our domestic network will continue to differentiate itself in all areas of our core 
                                competencies - supply chain management, logistics and e-commerce.
                            </p>
                            <p>
                                We will position ourselves as the preferred, seamless link to a country 
                                projected to be an economic superpower of the 21st Century. Through our 
                                technology development, premium services, quality network and strategic alliances, 
                                we plan to carve for ourselves a leadership position in the industry as India's 
                                and the region's link to the world.
                            </p>
                            <p>
                                We will continue to deliver value to our stakeholders through our People 
                                Philosophy and Corporate Governance based on distinctive Customer Service, 
                                Business Ethics and Accountability, and Profitability.
                            </p>
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
