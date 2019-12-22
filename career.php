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
            <?php include_once './header.php';?>
            <div class="container-fluid">
                <?php include_once './carousel.php'; ?>
                <div class="row mt-3">
                    <div class="col-12 mb-4">
                        <h3 class="font-weight-bold text-center mb-4">Job Opportunities</h3>
                        <div class="container text-secondary">
                            <p>
                                <?=COMPANY_NAME?> is India's leading courier and integrated air express 
                                package distribution company with dedicated aviation services. 
                                We have the most extensive domestic network covering over 35,000 locations, 
                                and service more than 38 states and territories through our Sales alliance with DHL, 
                                the premier global brand name in the express distribution services.
                            </p>
                            <p>
                                We invite you to be part of our family of learners and achievers. 
                                The differentiation we seek in our new recruits that sets them apart from the rest,
                                are passion and enthusiasm for work, service quality and customer care. 
                                Our customer is the focus of all our activities and the most important 
                                constituent of our business. We expect all our people to 'go the extra mile' 
                                for our customer.
                            </p>
                            <p>
                                <h4 class="text-secondary">Growth Opportunities</h4>
                            </p>
                            <p>
                                We are a learning organization and encourage development of knowledge, 
                                skills and attitudes to enable our people to perform to their full potential.
                                We have developed a corporate-wide training programme to bring learning to the work 
                                place through the use of in-house, qualified trainers and the intranet. 
                                Individual training needs are identified, training objectives are set, 
                                the appropriate module implemented and, finally, the effectiveness of the training 
                                is analysed and evaluated through the training MIS. The objective of the training is 
                                to build competencies to respond to the dynamic business environment, and to build leadership. 
                                Most of our managers have risen from the ranks.
                            </p>
                            <p>
                                <h4 class="text-secondary">Rewards</h4>
                            </p>
                            <p>
                                Our high-performers are well rewarded. We have exciting sales incentive schemes 
                                for our sales force, and our Bravo Award for outstanding performance 
                                and resourcefulness in the day-to-day processes.
                            </p>
                            <p>
                                <h4 class="text-secondary">Rewards</h4>
                            </p>
                            <p>
                                Our high-performers are well rewarded. We have exciting sales incentive schemes 
                                for our sales force, and our Bravo Award for outstanding performance 
                                and resourcefulness in the day-to-day processes.
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
