<!doctype html>
<html>
    <head>
        <title>Admin Login </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='https://fonts.googleapis.com/css?family=Exo:400,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <?php
//        include_once './favicon.php';
        ?>
        <script src="https://kit.fontawesome.com/5249859935.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
        <script language="JavaScript">

            /*
             * validate number
             */
            function validateText(txt) {
                var res = '';
                if (!isNaN(txt)) {
                    // check length of the number
                    if (txt.length == 10) {
                        // check the first digit of the number (6,7,8,9 only)
                        mod = (Math.floor((txt / 1000000000) % 10));
                        if (mod < 6) {
                            //	print error message for invalid number
                            res = "Please enter a valid number1";
                            $(".submit").attr("disabled", "");
                        } else {
                            $(".submit").removeAttr("disabled");
                        }
                    } else if (txt.length == 0) {
                        res = "";
                        $(".submit").removeAttr("disabled");
                    } else {
                        // print error message for invalid length
                        res = "Please enter a valid number2";
                        $(".submit").attr("disabled", "");
                    }
                } else {
                    res = validateEmail(txt);
                }
                $(".text-validation").html(res);
            }

            /*
             * validate email
             */
            function validateEmail(txt) {
                res = "";
                var re = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                if (re.test(txt) == false) {
                    res = "Please enter a valid email";
                    $(".submit").attr("disabled", "");
                } else {
                    res = "";
                    $(".submit").removeAttr("disabled");
                }
                $(".text-validation").html(res);
                return res;
            }

        </script>

        <style>
            html, body{
                height: 100%;
            }
            body { 
                background-image: url('img/bg-1.jpg');
                background-position: center center;
                background-repeat:  no-repeat;
                background-attachment: fixed;
                background-size:  cover;
            }
            .wrapper {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                width: 100%; 
                height:100%;
                bottom: 0; 
                display: block;
                position: absolute;
                background-color: rgba(0,0,0,0.6);
                color: #fff;
                padding: 0.5em;
            }
            *{
                font-family: "Poppins",sans-serif;
            }
            .demo{
                background-color: rgba(0, 0, 0, 0.5);
                border-radius: 10px;
            }
        </style>
    </head>
    <body class="bg-white img-fluid" oncontextmenu="return false;">
        <noscript>
        <meta HTTP-EQUIV="refresh" content=0;url="javascriptNotEnabled.html">
        <style type="text/css">
            .container-fluid { display:none; }
        </style>
        </noscript>
        <?php
        include_once 'constants.php';
//        include_once './code/Utilities.php';
//        $utilities = new Utilities();   
        $verify = 0;
        if (!empty($_GET['q'])) {
            $errorDetail = "";
            $err = $_GET['q'];
            if ($err == 3) {
                $errorDetail = "Enter correct credentials.";
            } else if ($err == 2) {
                $errorDetail = "Something went wrong.";
            } else if ($err == 1) {
                $errorDetail = "Something went wrong, Please login again.";
            } else if ($err == "verify") {
                $verify = 1;
            }
        }
        ?>
        <div class="container-fluid" >
            <div class="row ">
                <div class="wrapper d-flex align-items-center justify-content-center flex-column">
<?php
if (!empty($errorDetail)) {
    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= $errorDetail ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
<?php } ?>
                    <div class="demo col-xs-12 col-sm-6 col-md-6 col-lg-5 my-5">
                        <a href="<?= HOME ?>" title="Go to <?= HOME ?>" style="text-decoration: none;">
                            <h3 class="mt-5 mx-5 text-white text-center"> <?= COMPANY_NAME ?> | Login </h3>
                        </a>
                        <br />
                        <div class="col">
                            <form action="code/verifyLogin.php" method="post" class="">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email" name="username" 
                                           maxlength="100" onkeyup="validateText(this.value)" placeholder="Enter your email/mobile*" required="true" />
                                    <small id="nameHelp" class="text-validation form-text text-danger text-left"> </small>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password*" required="true" />
                                </div>
                                <div class="form-group">
                                    <input type="submit" 
                                           class="submit form-control mb-5 text-secondary font-weight-bold col-3 float-right" 
                                           name="submit" value="Login"  />
                                </div>
                            </form>
                        </div>
                        <hr class="mt-5" />
                        <div class="col ml-5 mb-3 text-center">
                            <span class="text-secondary border-3"> Create an account. 
                                <a href="register.php" class="text-info text-decoration-none">Sign up</a> </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>