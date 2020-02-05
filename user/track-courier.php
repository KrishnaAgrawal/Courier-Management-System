<?php
// Include autoloader 
require_once '../dompdf/autoload.inc.php';

// Reference the Dompdf namespace 
use Dompdf\Dompdf;

// Instantiate and use the dompdf class 
$dompdf = new Dompdf();

include_once '.././constants.php';
include_once '../code/Utilities.php';
$utilities = new Utilities();
$trackingId = '';
$q = 'error';
if (!empty($trackingId = $_GET['txt_tracking_id'])) {
    $query = 'SELECT * FROM tbl_courier_booking WHERE txt_tracking_id="' . $trackingId . '"';
//    echo $query;exit;
    if ($result = $utilities->selectQuery($query)) {
        if ($result->num_rows > 0) {
            if ($rows = $result->fetch_array()) {
                $trackingId = $rows['txt_tracking_id'];
                $temp = '';
                for ($i = 3; $i < 13; $i++) {
                    $temp .= $trackingId[$i];
                }
                $temp .= ' ';
                for ($i = 13; $i < 21; $i++) {
                    $temp .= $trackingId[$i];
                }
                $temp .= ' ';
                for ($i = 21; $i < 27; $i++) {
                    $temp .= $trackingId[$i];
                }
            }
            $t = " <!DOCTYPE html>
                    <html>
                        <head>
                        <title>".$trackingId."</title>
                    </head>
                    <body class='bg-light' oncontextmenu='return false;'>
                        <div style='width: 1200px; margin: 0px auto'>
                            <div style='width: 1200px; height: 200px; '>
                                <div style='width: 500px;float: left; margin-left: 100px;'>
                                    <h1 class=' ml-3'>" . COMPANY_NAME . "</h1>
                                    <p style=''><span>" . ADDRESS_4 . "</span></p>
                                </div>
                                <div style='width: 700px; float: left; margin-top: 80px'>
                                    <p><b>Tracking ID :</b> 
                                    <b>AWB</b> $temp</p>
                                </div>
                            </div>
                            <div style='width: 1000px; margin-left: 100px;'>
                                    <div style='width: 500px; float: left;'>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Sender's Name: </b>
                                            <span >" . $rows['txt_sender_name'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Sender's Mobile: </b>
                                            <span style=''>" . $rows['txt_sender_mobile'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Sender's Email: </b>
                                            <span style=''>" . $rows['txt_sender_email'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Sender's Address: </b>
                                            <span style=''>" . $rows['txt_sender_address_line1'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Origin: </b>
                                            <span style=''>" . $rows['txt_origin'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Item: </b>
                                            <span style=''>" . $rows['txt_courier_item_content'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Weight: </b>
                                            <span style=''>" . $rows['txt_weight'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Transport: </b>
                                            <span style=''>" . $rows['txt_transport_mode'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Price: </b>
                                            <span style=''>" . $rows['txt_price'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Courier Status: </b>
                                            <span style=''>" . $rows['txt_courier_status'] . "</span>
                                        </div>
                                    </div>
                                    <div style='width: 500px; float: left;'>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Recipient's Name: </b>
                                            <span style=''>" . $rows['txt_recipient_name'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Recipient's Mobile: </b>
                                            <span style=''>" . $rows['txt_recipient_mobile'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Recipient's Alternate Mobile: </b>
                                            <span style=''>" . $rows['txt_recipient_alternate_mobile'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Recipient's Email: </b>
                                            <span style=''>" . $rows['txt_recipient_email'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Recipient's Address: </b>
                                            <span style=''>" . $rows['txt_recipient_address_line1'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Destination: </b>
                                            <span style=''>" . $rows['txt_destination'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Pieces: </b>
                                            <span style=''>" . $rows['int_courier_item_pieces'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Pick Up Date: </b>
                                            <span style=''>" . $rows['dat_booked'] . "</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Expected Delivery Date: </b>
                                            <span style=''>" . $rows['dat_expected_delivery'] . "</span>
                                        </div>
                                        <div style='width: 1000px; margin-left: -260px; margin-top: 100px;'>
                                            <span class='text-light text-center;'>
                                                Copyright &copy; " . YEAR . " " . COMPANY_NAME . " all rights reserved.</span>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </body>
                    
                </html> ";
// Load HTML content 
            $dompdf->loadHtml($t);

// (Optional) Setup the paper size and orientation 
            $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF 
            $dompdf->render();

// Output the generated PDF to Browser 
//$dompdf->stream();
            $dompdf->stream($trackingId, array("Attachment" => 0));
        }
    }
}
echo "<script>alert('Enter your Tracking ID without any space which starts with \'AWB\'');window.history.back();</script>";
//}
?>