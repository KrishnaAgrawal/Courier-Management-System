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
        <div class="container-fluid bg-light">
            <?php
            include_once './userHeader.php';
            include_once '../code/Utilities.php';
            $utilities = new Utilities();
            include_once '../constants.php';
            $name = $_SESSION['name'];
            $number = $_SESSION['number'];
            $email = $_SESSION['email'];
            $city = '';
            $state = '';
            $address = '';
            $occupation = '';
            $query = "SELECT * FROM tbl_registration WHERE txt_name = \"$name\" AND"
                    . " txt_number = \"$number\" AND txt_email = \"$email\" AND "
                    . " ysn_deleted = 0";
            if ($result = $utilities->selectQuery($query)) {
                if ($rows = $result->fetch_array()) {
                    $name = $rows['txt_name'];
                    $number = $rows['txt_number'];
                    $email = $rows['txt_email'];
                    $city = $rows['txt_city'];
                    $state = $rows['txt_state'];
                    $address = $rows['txt_address'];
                    $occupation = $rows['txt_occupation'];
                    $registrationId = $rows['int_registration_id'];
            ?>
            <div class="container-fluid">
                <div class="container mt-4">
                <?php
                    if (!empty($_GET['q'])) {
                        $errorDetail = "";
                        $errorColor = "alert-danger text-danger";
                        $q = $_GET['q'];
                        if ($q == 'saved') {
                            $errorDetail = "Updated Successfully.";
                        $errorColor = "alert-success text-success";
                        } else if ($q == 'error') {
                            $errorDetail = "Something went wrong.";
                        } else if($q == 'noMatch'){
                            $errorDetail = "<i><b>New Password</b></i> and <i><b>Repeat New Password</b></i> does not match.";
                        } else if($q == 'wPswd'){
                            $errorDetail = "<i><b>Current Password</b></i> is incorrect.";
                        }
                    }
                    if (!empty($errorDetail)) {
                        ?>
                        <div class="alert <?=$errorColor?> alert-dismissible font-weight-bold fade show text-center" role="alert">
                        <?= $errorDetail ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <div class="container ">
                        <div class="col-sm-12 my-4" id="user">
                            <div class="separator">
                                <h4 class="ask font-weight-bold fa-2x text-center my-4">Change Password</h4>
                            </div>
                        </div>
                    </div>
                    <form action="code/changeEmployeePassword.php" method="post" class="">
                        <div class="form-group">
                            <label for="inputName4"  class="font-weight-bold">Current Password<span class="text-danger font-weight-bold">*</span></label>
                            <input type="text" name="currentPasssword" required="" class="form-control" id="inputName4" placeholder="Enter your current password.">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress" class="font-weight-bold">New Password<span class="text-danger font-weight-bold">*</span></label>
                                <input type="text" name="newPasssword1" required="" class="form-control" id="inputNumber" placeholder="Enter your new password.">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputUserType2" class="font-weight-bold">Repeat New Password<span class="text-danger font-weight-bold">*</span></label>
                                <input type="text" name="newPasssword2" required="" class="form-control" id="inputUserType2" placeholder="Enter your new password.">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary my-3 font-weight-bold">Modify</button>
                    </form>
                </div>
            </div>
            <?php
                }
            } else {
                echo 'No data found.';
            }
            ?>
        </div>
        <div class="container-fluid footer-copyright text-center bg-dark fixed-bottom">
            <div class="row">
                <div class="container my-3">
                    <span class="text-light text-center">Copyright &copy; <?= YEAR ?> <a href="../index.php"><?= COMPANY_NAME ?></a> all rights reserved.</span>
                </div>
            </div>
        </div>
    </body>
</html>
