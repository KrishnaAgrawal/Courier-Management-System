<div class="row">
    <div class="container-fluid bg-white">
        <div class="row top-bar">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 no-l-pad" id="mainlogo"> 
                <h1><a href="" class="font-weight-bold a-hover h1-font-size"><?= COMPANY_NAME ?> | Admin</a> </h1>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 top-menu">
                <ul class="float-right navbar-right mt-2">
                    <li class="line-ht style"><a href="my-account.php" class="a-hover"><i class="fa fa-user-alt"></i> <?= $_SESSION['name'] ?></a></li>
                    <li class="signup-btn style ml-4 mr-2">
                        <a class="a-hover" href="logout.php">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <!--<a class="navbar-brand" href="#">Track</a>-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item menu">
                        <a class="nav-link" aria-disabled="true" href="index.php">Dashboard <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item menu">
                        <a class="nav-link" aria-disabled="true" href="courier-package.php">Courier Package <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item dropdown menu">
                        <a class="nav-link dropdown-toggle" aria-disabled="true" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Services 
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Track Courier</a>
                            <a class="dropdown-item" href="../location-finder.php">Location Finder</a>
                            <a class="dropdown-item" href="../find-time&price.php">Find Time & Price</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown menu">
                        <a class="nav-link dropdown-toggle" aria-disabled="true" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Managements 
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="index.php#user">User</a>
                            <a class="dropdown-item" href="manage-feedback.php">Feedback</a>
                            <a class="dropdown-item" href="manage-review.php">Review</a>
                            <a class="dropdown-item" href="manage-complaint.php">Complaint</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown menu">
                        <a class="nav-link dropdown-toggle" aria-disabled="true" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Approve 
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="approve-user.php">User</a>
                            <a class="dropdown-item" href="approve-courier-package.php">Courier Package</a>
                            <a class="dropdown-item" href="approve-review.php">Review</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown menu">
                        <a class="nav-link dropdown-toggle" aria-disabled="true" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Settings 
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="my-account.php">My Account</a>
                            <a class="dropdown-item" href="change-password.php">Change Password</a>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>