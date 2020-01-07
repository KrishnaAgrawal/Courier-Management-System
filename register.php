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
            <div class="row">
                <div class="wrapper d-flex align-items-center justify-content-center flex-lg-row">
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
                    <div class="demo col-xs-12 col-sm-12 col-md-9 col-lg-9 my-5">
                        <a href="<?= HOME ?>" title="Go to <?= HOME ?>" style="text-decoration: none;">
                            <h3 class="mt-5 mx-5 text-white text-center"> <?= COMPANY_NAME ?> | Registration </h3>
                        </a>
                        <br />
                        <div class="col">
                            <form action="code/verifyLogin.php" method="post" class="">
                                <div class="form-row mb-2">
                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <label>Name<span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" 
                                               maxlength="100" onkeyup="validateName(this.value)" placeholder="Enter your name*" required="true" />
                                        <small id="nameHelp" class="name-validation form-text text-danger text-left"> </small>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               maxlength="100" onkeyup="validateEmail(this.value)" placeholder="Enter your email"/>
                                        <small id="nameHelp" class="email-validation form-text text-danger text-left"> </small>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <label>Number<span class="text-danger font-weight-bold">*</span></label>
                                        <input type="number" class="form-control" id="number" name="number" 
                                               maxlength="100" onkeyup="validateNumber(this.value)" placeholder="Enter your number*" required="true" />
                                        <small id="nameHelp" class="number-validation form-text text-danger text-left"> </small>
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <label>Occupation<span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" class="form-control" id="occupation" name="occupation" 
                                               maxlength="100" onkeyup="validateOccupation(this.value)" placeholder="Enter your occupation*"/>
                                        <small id="nameHelp" class="occupation-validation form-text text-danger text-left"> </small>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <label>City<span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" class="form-control" id="city" name="city" 
                                               maxlength="100" onkeyup="validateCity(this.value)" placeholder="Enter your city*"/>
                                        <small id="nameHelp" class="city-validation form-text text-danger text-left"> </small>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <label>State<span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" class="form-control" id="state" name="state" 
                                               maxlength="100" onkeyup="validateState(this.value)" placeholder="Enter your state*" required="true" />
                                        <small id="nameHelp" class="state-validation form-text text-danger text-left"> </small>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label>Address<span class="text-danger font-weight-bold">*</span></label>
                                        <textarea class="form-control" id="address" name="address" rows="2" style="resize: none" 
                                              maxlength="500" placeholder="Enter your full address for secure pickup/delivery.*"></textarea>
                                    <!--<small id="nameHelp" class="state-validation form-text text-danger text-left"> </small>-->
                                </div>
                                <div class="form-row mb-2">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <label>Password<span class="text-danger font-weight-bold">*</span></label>
                                        <input type="password" class="form-control" id="password1" name="password1" 
                                               maxlength="100" placeholder="Enter your password*" required="true" />
                                        <small id="nameHelp" class="password-validation form-text text-danger text-left"> </small>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <label>Re-Enter Password<span class="text-danger font-weight-bold">*</span></label>
                                        <input type="password" class="form-control" id="password2" name="password2" 
                                               maxlength="100" placeholder="Re-Enter your password*"/>
                                        <small id="nameHelp" class="password-validation form-text text-danger text-left"> </small>
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <label>Enter Captcha<span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" class="form-control" id="captcha" name="captcha" 
                                               placeholder="Enter captcha*" required="true" />
                                        <small id="nameHelp" class="captcha-validation form-text text-danger text-left"> </small>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <img class="mt-4 mg-fluid" src="captcha.php" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" 
                                           class="submit form-control mb-5  ml-3 text-secondary font-weight-bold col-3 float-right" 
                                           name="submit" value="Login"  />
                                    <input type="reset" 
                                           class="reset form-control mb-5 text-secondary font-weight-bold col-3 float-right" 
                                           value="Reset"  />
                                </div>
                            </form>
                        </div>
                        <hr class="mt-5" />
                        <div class="col ml-5 mb-3 text-center">
                            <span class="text-secondary border-3">Already have an account? 
                                <a href="login.php" class="text-info text-decoration-none">Login</a> </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>