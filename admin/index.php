<?php
session_start();
if(empty($_SESSION) || empty($_SESSION['name']) || empty($_SESSION['number']) || empty($_SESSION['email'])){
    session_destroy();
    echo "<script>window.location.href='./login.php';</script>";
}
echo '<pre>';print_r($_SESSION);exit;
?>