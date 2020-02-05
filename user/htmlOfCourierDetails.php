<?php
// Include the qrlib file 

include_once '.././constants.php';
include_once '../code/Utilities.php';
$utilities = new Utilities();
$trackingId = '';
$q = 'error';
if (!empty($trackingId = $_GET['txt_tracking_id'])) {
    $query = "SELECT * FROM tbl_courier_booking WHERE txt_tracking_id=\"$trackingId\"";
    if ($result = $utilities->selectQuery($query)) {
        if ($result->num_rows > 0) {
            if ($rows = $result->fetch_array()) {
                $trackingId = $rows['txt_tracking_id'];
                $temp = '';
                for($i = 3; $i < 13; $i++){
                    $temp .= $trackingId[$i];
                }
                $temp .= ' ';
                for($i = 13; $i < 21; $i++){
                    $temp .= $trackingId[$i];
                }
                $temp .= ' ';
                for($i = 21; $i < 27; $i++){
                    $temp .= $trackingId[$i];
                }
                ?>
                <!DOCTYPE html>
                <html>
                    <body class="bg-light" oncontextmenu="return false;">
                        <div style='width: 1000px; margin: 0px auto'>
                            <div style='width: 1000px; height: 200px; '>
                                <div style='width: 750px;float: left;'>
                                    <h1 class=' ml-3'>". COMPANY_NAME ."</h1>
                                    <p class='ml-5'><span>". ADDRESS_4 ."</span></p>
                                </div>
                                <div style='width: 250px; float: left;'>
                                    <p class='mt-5 float-right'>
                                        <span class='mt-3 font-weight-bold text-primary'>
                                            <span class='text-dark'>AWB</span>
                                                $temp
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div style='width: 1000px; height: 500px;'>
                                    <div style='width: 500px; float: left;'>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Sender's Name: </b>
                                            <span class="">".$rows['txt_sender_name']."</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Sender's Mobile: </b>
                                            <span class="">".$rows['txt_sender_mobile']."</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Sender's Email: </b>
                                            <span class="">".$rows['txt_sender_email']."</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Sender's Address: </b>
                                            <span class="">".$rows['txt_sender_address_line1']."</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Origin: </b>
                                            <span class="">".$rows['txt_origin']."</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Item: </b>
                                            <span class="">".$rows['txt_courier_item_content']."</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Weight: </b>
                                            <span class="">".$rows['txt_weight']."</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Transport: </b>
                                            <span class="">".$rows['txt_transport_mode']."</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Price: </b>
                                            <span class="">".$rows['txt_price']."</span>
                                        </div>
                                    </div>
                                    <div style='width: 500px; float: left;'>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Recipient's Name: </b>
                                            <span class="">".$rows['txt_recipient_name']."</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Recipient's Mobile: </b>
                                            <span class="">".$rows['txt_recipient_mobile']."</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Recipient's Alternate Mobile: </b>
                                            <span class="">".$rows['txt_recipient_alternate_mobile']."</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Recipient's Email: </b>
                                            <span class="">".$rows['txt_recipient_email']."</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Recipient's Address: </b>
                                            <span class="">".$rows['txt_recipient_address_line1']."</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Destination: </b>
                                            <span class="">".$rows['txt_destination']."</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Pieces: </b>
                                            <span class="">".$rows['int_courier_item_pieces']."</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Pick Up Date: </b>
                                            <span class="">".$rows['dat_booked']."</span>
                                        </div>
                                        <div style='margin-top: 20px;'>
                                            <b style='margin-top: 10px;'>Expected Delivery Date: </b>
                                            <span class="">".$rows['dat_expected_delivery']."</span>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-5" />
                        <div class="container-fluid footer-copyright text-center bg-dark mt-5">
                            <div class="row mt-5">
                                <div class="container my-3">
                                    <span class="text-light text-center">Copyright &copy; ". YEAR ?> <a href="../index.php">". COMPANY_NAME ?></a> all rights reserved.</span>
                                </div>
                            </div>
                        </div>
                    </body>
                </html>
                <?php
            }
        }
    }
}
?>