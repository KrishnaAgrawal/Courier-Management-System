<div class="container-fluid">
    <div class="row top-bar bg-light">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 no-l-pad" id="mainlogo"> 
            <h1><a href="" class="font-weight-bold a-hover h1-font-size"><?=COMPANY_NAME?></a> </h1>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 top-menu">
            <ul class="float-right navbar-right mt-2">
                <li class="line-ht style"><a href="<?=MOBILE_LINK?>" class="a-hover"><i class="fa fa-phone-alt"></i> <?=MOBILE?></a></li>
                <li class="signup-btn style ml-4 mr-2">
                    <a class="a-hover" href="login.php">
                        <img src="img/user.gif" class="user"> Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!--<a class="navbar-brand" href="#">Track</a>-->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item menu">
                <a class="nav-link" aria-disabled="true" href="index.php">Home <span class="sr-only"></span></a>
            </li>
            <li class="nav-item dropdown menu">
                <a class="nav-link dropdown-toggle" aria-disabled="true" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Services 
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="track-courier.php">Track Courier</a>
                    <a class="dropdown-item" href="location-finder.php">Location Finder</a>
                    <a class="dropdown-item" href="find-time&price.php">Find Time & Price</a>
                </div>
            </li>
            <li class="nav-item dropdown menu">
                <a class="nav-link dropdown-toggle" aria-disabled="true" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    About Us
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="about-us.php">Anant Couriers</a>
                    <a class="dropdown-item" href="milestones.php">Milestones</a>
                    <a class="dropdown-item" href="future-plan.php">Future Plans</a>
                </div>
            </li>
            <li class="nav-item dropdown menu">
                <a class="nav-link dropdown-toggle" aria-disabled="true" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Contact Us
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="call-us.php">Call Us</a>
                    <a class="dropdown-item" href="write-us.php">Write To Us</a>
                    <a class="dropdown-item" href="24-hour-counter.php">24 Hours Counters</a>
                </div>
            </li>
            <li class="nav-item menu">
                <a class="nav-link" aria-disabled="true" href="career.php">Careers</a>
            </li>
        </ul>
    </div>
</nav>