<?php
include '../phpqrcode/qrlib.php'; 
$text = "http://localhost/cms-1/user/u-courier-package.php"; 
QRcode::png($text);