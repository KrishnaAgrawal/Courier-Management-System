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
            <?php include_once './header.php';
            include_once './calc-user-hits.php';?>
            <div class="container-fluid">
                <?php include_once './carousel.php'; ?>
                <div class="row mt-3">
                    <div class="col-12 mb-4">
                        <h3 class="font-weight-bold text-center mb-4">About Us</h3>
                        <div class="container text-secondary">
                            <p>
                                <?=COMPANY_NAME?> Ltd., India's premier express air and integrated 
                                transportation & distribution company, offers secure and reliable delivery 
                                of consignments to over 35,000 locations in India. As part of the 
                                Post - E-commerce - Parcel (PeP) division, <?=COMPANY_NAME?> accesses the largest and most 
                                comprehensive express and logistics network covering over 38 
                                states and territories.
                            </p>
                            <p>
                                The <?=COMPANY_NAME?> team drives market leadership through its motivated people force, 
                                dedicated air and ground capacity, cutting-edge technology, 
                                wide range of innovative, vertical specific products and value-added services 
                                to deliver unmatched standards of service quality to its customers. 
                                <?=COMPANY_NAME?>'s market leadership is further validated by numerous awards and 
                                recognitions from customers for exhibiting reliability, superior brand 
                                experience and sustainability which include recognition as one 
                                of ‘India's Best Companies to Work For’ by The Great Place to Work® Institute, 
                                amongst the Top 25 Best Employers in India 2016 by AON Hewitt, 
                                voted as a Superbrand, listed as one of Fortune 500’s India's Largest 
                                Corporations and Forbes India's Super 50 Companies and voted Reader’s 
                                Digest Most Trusted Brand to name a few.
                            </p>
                            <p>
                                <?=COMPANY_NAME?> accepts its social responsibility by supporting climate protection (GoGreen), 
                                disaster management (GoHelp) and education (GoTeach).
                            </p>
                        </div>
                    </div>
                </div>
            </div>
                <?php 
                 include_once './goToTop.php';
                include_once './address&imp-link.php'; ?>
            
        </div>
    </body>
</html>
