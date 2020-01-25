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
            include_once './adminHeader.php';
            include_once '../code/Utilities.php';
            $utilities = new Utilities();
            include_once '../constants.php';
            $name = $_SESSION['name'];
            $number = $_SESSION['number'];
            $email = $_SESSION['email'];
            $userType = $_SESSION['user_type'];
            $query = "SELECT * FROM tbl_login WHERE txt_name = \"$name\" AND"
                    . " txt_number = \"$number\" AND txt_email = \"$email\" AND "
                    . "ysn_user_type = \"$userType\" AND ysn_deleted = 0";
            if ($result = $utilities->selectQuery($query)) {
                if ($rows = $result->fetch_array()) {
                    $name = $rows['txt_name'];
                    $number = $rows['txt_number'];
                    $email = $rows['txt_email'];
                    $registrationId = $rows['int_registration_id'];
                    $loginId = $rows['int_login_id'];
                    $userType = ($rows['ysn_user_type'] == 1 ? "Admin" : "Customer");
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
                    <h3 class="text-center font-weight-bold my-4"><span class="">My Account</span></h3>
                    <form action="code/updateAdminInfo.php" method="post" class="">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputName4"  class="font-weight-bold">Name<span class="text-danger font-weight-bold">*</span></label>
                                <input type="text" value="<?=$name?>" name="name" required="" class="form-control" id="inputName4" placeholder="Enter your name.">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4" class="font-weight-bold">Email<span class="text-danger font-weight-bold">*</span></label>
                                <input type="email" value="<?=$email?>" readonly="" name="email" class="form-control" id="inputEmail4" placeholder="Enter your email.">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress" class="font-weight-bold">Number<span class="text-danger font-weight-bold">*</span></label>
                                <input type="text" value="<?=$number?>" name="number" readonly="" class="form-control" id="inputNumber" placeholder="Enter your number.">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputUserType2" class="font-weight-bold">User Type<span class="text-danger font-weight-bold">*</span></label>
                                <input type="text" value="<?=$userType?>" readonly="" title="User Type can not be modified." class="form-control" id="inputUserType2">
                            </div>
                        </div>
                        <input type="text" value="<?=$registrationId?>" name="registrationId" hidden="" class="form-control">
                        <input type="text" value="<?=$loginId?>" name="loginId" hidden="" class="form-control">
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
