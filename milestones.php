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
            <?php include_once './header.php';
            include_once './code/Utilities.php';
            include_once './calc-user-hits.php';?>
            <div class="container-fluid">
                <?php include_once './carousel.php'; ?>
                <div class="row mt-3">
                    <div class="col-12 mb-4">
                        <h3 class="font-weight-bold text-center mb-4">Milestones</h3>
                        <div class="container text-secondary">
                            
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2000</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>Two young entrepreneurs, Anjali and Khushroo Dubash, 
                                        set up <?=COMPANY_NAME?> with a capital base of ₹ 30,000/-. In a space of 200sq. ft. 
                                        under a staircase, <?=COMPANY_NAME?> was born as an idea of delivering small 
                                        packages and samples to support India's burgeoning exports.
                                    </p> 
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2001</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        <?=COMPANY_NAME?> launches its 1rd aircraft operations on the 
                                        Bangalore-Delhi-Bangalore sector.
                                    </p>
                                    <p>
                                        <?=COMPANY_NAME?> also partnered with the Civil Aviation Ministry 
                                        to assist with relief operations into an earthquake-battered Bhuj in Gujarat.
                                    </p>
                                    <p>
                                        Technology tools and customer software were developed 
                                        in-house and launched.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2002</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        <?=COMPANY_NAME?> is one of the few Indian companies to 
                                        be re-certified to the new global ISO 9001 - 2000 standards for "Design,
                                        management and operations of countrywide express transportation and 
                                        distribution service within the Indian subcontinent".
                                    </p>
                                    <p>
                                        <?=COMPANY_NAME?> ends its contract with Federal Express and 
                                        signs a path-breaking Sales Alliance with the World's No. 1 international 
                                        air express company, DHL Worldwide Express. <?=COMPANY_NAME?> crosses 
                                        100,000 shipments per day.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2003</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        <?=COMPANY_NAME?> acquires its 2nd Boeing 737 freighter. 
                                        With a focus on strengthening infrastructure, <?=COMPANY_NAME?> 
                                        establishes 12 of its own offices in the South, 
                                        added an additional 198 locations to its delivery network, 
                                        expands its hub at Bhiwandi and sets up a bonded warehouse in Mumbai.
                                    </p>
                                    <p>
                                        <?=COMPANY_NAME?> is chosen as a 'Superbrand' from over 700 brands 
                                        across 98 categories by a jury of eminent marketing and advertising 
                                        professionals. The company celebrated 20 years of service to the 
                                        nation on 19th November 2003.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2004</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        <?=COMPANY_NAME?> inducts its 3rd aircraft into operation on 17th May 2004, 
                                        connecting Hyderabad as its 6th Aviation Hub, followed by the acquisition 
                                        of its 3rd Boeing 737 freighter the same year.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2006</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        <?=COMPANY_NAME?> launches its unique SMS based Mobile Tracking Service.
                                    </p>
                                    <p>
                                        A decade after its launch of India's first domestic express airline, 
                                        <?=COMPANY_NAME?> introduces the 1st Boeing 757 freighters in the Indian 
                                        skies on 1st June 2006 with 2 of these aircraft connecting the 5 
                                        major metros of Delhi, Mumbai, Chennai, Bengaluru and Kolkata. 
                                        A second flight was launched from Hyderabad while Ahmedabad became the 
                                        7th airport to join <?=COMPANY_NAME?>'s network.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2007</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        <?=COMPANY_NAME?> invests in a 3rd Boeing B757 freighter.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2008</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        The first integrated <?=COMPANY_NAME?>facility was set up in Bangalore.
                                    </p>
                                    <p>
                                        <?=COMPANY_NAME?> inducts 4th Boeing B757 freighter.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2009</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        <?=COMPANY_NAME?> earns the title of a 'SuperBrand' for the 5th time in a row.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2010</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        <?=COMPANY_NAME?> reaches a new benchmark in quality service with 
                                        an ISO 9001-2015 standards certification.
                                    </p>
                                    <p>
                                        Readers' Digest voted <?=COMPANY_NAME?> as the 
                                        'Most Trusted Brand' for the 5th time in a row.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2011</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        <?=COMPANY_NAME?> launches Smart Truck, making logistics more time and 
                                        cost-effective. It also launches its Carbon Neutral Service under the 
                                        'GoGreen' initiative.
                                    </p>
                                    <p>
                                        <?=COMPANY_NAME?> is awarded the Great Place To Work (GPTW) title for the 2nd time.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2012</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        <?=COMPANY_NAME?> strengthens its community outreach initiatives by 
                                        introducing and celebrating World CSR Day.
                                    </p>
                                    <p>
                                        The company inducted its 5th B757-200 freighter into its fleet.
                                    </p>
                                    <p>
                                    <?=COMPANY_NAME?> is awarded the GPTW title for the 3rd time.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2013</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        <?=COMPANY_NAME?> commemorates 13 years of being India's foremost courier service.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2014</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        <?=COMPANY_NAME?> announces plans to launch a separate structure for e-tailing.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2015</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        Launched India's 1st Parcel Locker in Gurgaon.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2016</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        Recognised amongst the top 50 of India's Best Companies to 
                                        Work for by Great Place to Work, India.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2017</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        Voted a Business Superbrand for the 10th consecutive year.
                                    </p>
                                    <p>
                                        <?=COMPANY_NAME?> powers last-mile deliveries with electric vehicles in Gurgaon.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2018</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        Expanded reach to pin codes across Tier 2,3, 4 towns.
                                    </p>
                                    <p>
                                        Voted a Business Superbrand for the 11th consecutive year.
                                    </p>
                                </div> 
                            </div>
                            <div class="media"> 
                                <div class="media-left bg-green btn btn-sm"> 
                                    <div class="year-box pull-left">2019</div> 
                                </div> 
                                <div class="media-body ml-2 mb-4"> 
                                    <p>
                                        Voted a Business Superbrand for the 12th consecutive year.
                                        Expanded reach to 14,000+ pin codes.
                                    </p>
                                    <p>
                                    </p>
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
