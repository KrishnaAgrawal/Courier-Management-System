<?php
include_once '../constants.php';
?>
<html lang="en" class="gr__localhost">
    <head>
        <!-- Title -->
        <title><?= COMPANY_NAME ?> |  Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta charset="UTF-8">
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css">
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">        
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css">
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css">
    </head>
    <body class="signin-page loaded" data-gr-c-s-loaded="true"><div id="materialPreloader" class="load-bar" style="height: 5px; top: 0px; display: none;"><div class="load-bar-container"><div class="load-bar-base base1" style="background:#159756"><div class="color red" style="background:#da4733"></div><div class="color blue" style="background:#3b78e7"></div><div class="color yellow" style="background:#fdba2c"></div><div class="color green" style="background:#159756"></div></div></div> <div class="load-bar-container"><div class="load-bar-base base2" style="background:#159756"><div class="color red" style="background:#da4733"></div><div class="color blue" style="background:#3b78e7"></div><div class="color yellow" style="background:#fdba2c"></div> <div class="color green" style="background:#159756"></div> </div> </div> </div>

        <div class="mn-content valign-wrapper">

            <main class="mn-inner container">
                <h4 align="center"><a href="../index.php"><?= COMPANY_NAME ?> | Admin Login</a></h4>
                <div class="valign">
                    <div class="row">

                        <div class="col s12 m6 l4 offset-l4 offset-m3">
                            <div class="card white darken-1">
                                <div class="card-content ">
                                    <span class="card-title">Sign In</span>
                                    <div class="row">
                                        <form class="col s12" name="signin" method="post" action="#">
                                            <div class="input-field col s12">
                                                <input id="username" type="text" name="username" class="validate valid" autocomplete="off" required="">
                                                <label for="email" class="active">Username</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input id="password" type="password" class="validate valid" name="password" autocomplete="off" required="">
                                                <label for="password" class="active">Password</label>
                                            </div>
                                            <div class="col s12 right-align m-t-sm">

                                                <i class="waves-effect waves-light btn teal waves-input-wrapper" style=""><input type="submit" name="signin" value="Sign in" class="waves-button-input"></i>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>


        <div class="hiddendiv common"></div></body></html>


