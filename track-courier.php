<!DOCTYPE html>
<?php
include_once './constants.php';
$trackingId = '';
if(!empty($arrPost = $_POST)){
    if(!empty($arrPost['Find'])){
        if(!empty($trackingId = $arrPost['txt_courier_status'])){
            echo "<script>window.location.href='user/track-courier.php?txt_tracking_id=".$trackingId."';</script>";
        }
    }
//    echo '<pre>';print_r($result);exit;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
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
        <div class="container-fluid">
            <?php include_once './header.php';
            include_once './calc-user-hits.php'; ?>
            <div class="bd-example">
                <?php include_once './carousel.php'; ?>
                <div class="row mt-3" id="top">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
                        <h3 class="font-weight-bold text-center">Track your Courier</h3>
                    </div>
                </div>
                <div class="container">
                    <form action="track-courier.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6 autocomplete">
                                <label for="location" class="font-weight-bold">Tracking ID<sup class="text-danger">*</sup>:</label>
                                <input type="text" class="form-control" name="txt_courier_status" id="txt_courier_status"
                                       required=""
                                       placeholder="Type here... AWB20200125071218">
                                <small class="text-primary" id="courier-status-box">Enter your Tracking ID without any space which starts with <b>'AWB'</b></small>
                            </div>
                        </div>
                        <i class="requiredFields"><sup class="text-danger font-weight-bold">*</sup>Indicates required fields.</i>
                        <br />
                        <input type="submit" name="Find" class="btn btn-success mt-2" value="Find" />
                        <input type="reset" class="btn btn-success mt-2" value="Reset" />
                    </form>
                    <?php
                    include_once './goToTop.php';
                    ?>
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
