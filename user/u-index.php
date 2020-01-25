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
                <div class="row mt-3 mb-5" style="height: 400px;">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 btn size mb-4">
                        <div class="card border-secondary mb-3">
                            <div class="card-header bg-secondary text-white font-weight-bold">My Complaints</div>
                            <div class="card-body text-primary" style="min-height: 350px;">

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 btn size mb-4">
                        <div class="card border-secondary mb-3">
                            <div class="card-header bg-secondary text-white font-weight-bold">My Feedback</div>
                            <div class="card-body text-primary">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mb-5">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 btn size mb-4">
                        <div class="card border-secondary mb-3">
                            <div class="card-header bg-secondary text-white font-weight-bold">My Complaints</div>
                            <div class="card-body text-primary">

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 btn size mb-4">
                        <div class="card border-secondary mb-3">
                            <div class="card-header bg-secondary text-white font-weight-bold">My Feedback</div>
                            <div class="card-body text-primary">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once 'userFooter.php'; ?>
    </body>
</html>
