<?php
$action = "";
$arrPost = [];
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}
if (!empty($_POST)) {
    $arrPost = $_POST;
}
switch ($action) {
    case "timeAndPrice" : getTimeAndPrice($arrPost);
        break;
    case "from" : getFromSource($arrPost);
        break;;
    case "to" : getToSource($arrPost);
        break;
    case "locationFinder" : getResultAddressOfGivenLoaction($arrPost);
        break;
//    default : echo 111;exit;
}

/*
 * get time and price of the courier package
 */

function getTimeAndPrice($arrPost) {
    if (!empty($arrPost['from']) && !empty($arrPost['to']) && !empty($arrPost['weight']) && !empty($arrPost['bookingDate'])) {
        $distance = 0;
        $from = $arrPost['from'];
        $to = $arrPost['to'];
        $weight = $arrPost['weight'];
        $bookingDate = $arrPost['bookingDate'];
        $from = getLatLong($from);
        $to = getLatLong($to);
        $distance = getDistanceBetweenFromAndTo($from, $to);
        $calculatedPriceDate = calculatePriceDate($distance, $weight, $bookingDate);
        echo json_encode($calculatedPriceDate);
    } else {
        echo "ERROR";
    }
}

/*
 * get lat long
 */

function getLatLong($address) {
    $address = str_replace(" ", "+", $address);
    $json = file_get_contents("https://api.opencagedata.com/geocode/v1/json?q=$address&key=400bf1f63706476d8cbe38eb14bd8e46");
    $json = json_decode($json);
    $lat = $json->{'results'}[0]->{'geometry'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'lng'};
    return [
        'lat' => $lat,
        'long' => $long,
    ];
}

/*
 * get Distance Between From And To 
 */

function getDistanceBetweenFromAndTo($from, $to) {
    $lon1 = $from['long'];
    $lat1 = $from['lat'];
    $lon2 = $to['long'];
    $lat2 = $to['lat'];
    $theta = $lon1 - $lon2;
    $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
    $miles = acos($miles);
    $miles = rad2deg($miles);
    $miles = $miles * 60 * 1.1515;
    $kilometers = ($miles * 1.609344);
//    $feet = $miles * 5280;
//    $yards = $feet / 3;
//    $meters = $kilometers * 1000;
    return $kilometers * 1.25;
}

/*
 * calculate Price
 */

function calculatePriceDate($distance, $weight, $bookingDate) {
    $baseDocumentPrice = 400;
    $baseAirPrice = 1000;
    $baseGroundPrice = 150;
    $documentDeliveryDate = $airDeliveryDate = $groundDeliveryDate = date("d-m-Y", strtotime("+1 day", strtotime($bookingDate)));
    if($distance > 200){
        $documentDeliveryDate = date("d-m-Y", strtotime("+3 day", strtotime($bookingDate)));
        $airDeliveryDate = date("d-m-Y", strtotime("+3 day", strtotime($bookingDate)));
        $groundDeliveryDate = date("d-m-Y", strtotime("+7 day", strtotime($bookingDate)));
    }
    $documentPrice = $baseDocumentPrice + $weight * 200 + $distance;
    $airPrice = $baseAirPrice + $weight * 150 + $distance;
    $groundPrice = $baseGroundPrice + $weight * 20 + $distance;
    return [
        'documentPrice' => ceil($documentPrice),
        'airPrice' => ceil($airPrice),
        'groundPrice' => ceil($groundPrice),
        'documentDeliveryDate' => $documentDeliveryDate,
        'airDeliveryDate' => $airDeliveryDate,
        'groundDeliveryDate' => $groundDeliveryDate,
    ];
}

/*
 * getFromSource($arrPost);
 */

function getFromSource($arrPost) {
    if (!empty($from = $arrPost['from'])) {
        $result = getFullAddress($from);
        ?>
        <div class="autocomplete-items" aria-labelledby="navbarDropdown">
          <!--<a class="dropdown-item" href="#">Action</a>-->
            <?php
            if(!empty($result)){
                while ($rows = $result->fetch_array()) {
                    ?>
                    <div class="autocomplete-active" onClick="selectFrom('<?= $rows["txt_district_name"]." ".$rows['txt_state_name']." - ".$rows['int_pincode']; ?>');">
                        <?= $rows["txt_district_name"]." ".$rows['txt_state_name']." - ".$rows['int_pincode']; ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }
}

/*
 * getFromSource($arrPost);
 */

function getToSource($arrPost) {
    if (!empty($to = $arrPost['to'])) {
        $result = getFullAddress($to);
        ?>
        <div class="autocomplete-items" aria-labelledby="navbarDropdown">
          <!--<a class="dropdown-item" href="#">Action</a>-->
            <?php
            if(!empty($result)){
                while ($rows = $result->fetch_array()) {
                    ?>
                    <div class="autocomplete-active" onClick="selectTo('<?= $rows["txt_district_name"]." ".$rows['txt_state_name']." - ".$rows['int_pincode']; ?>');">
                        <?= $rows["txt_district_name"]." ".$rows['txt_state_name']." - ".$rows['int_pincode']; ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }
}

/*
 * get result
 */
function getFullAddress($address, $removeLimit=0){
    @include_once './Utilities.php';
    $utilities = new Utilities();
    $arrAddress = [];
    $str = "";
    $limit = "LIMIT 0,5";
    if(!empty($removeLimit)){
        $limit = "";
    }
    if (strpos($address, ' ') !== false) {
        $arrAddress = explode(" ", $address);
    }
    if (strpos($address, ',') !== false) {
        $arrAddress = array_merge($arrAddress, explode(",", $address));
    }
    if (strpos($address, ', ') !== false) {
        $arrAddress = array_merge($arrAddress, explode(", ", $address));
    }
    if (strpos($address, ' ,') !== false) {
        $arrAddress = array_merge($arrAddress, explode(", ", $address));
    }
    if (strpos($address, ' - ') !== false) {
        $arrAddress = array_merge($arrAddress, explode(" - ", $address));
    }
    if (!empty($arrAddress)) {
        $arrAddress = array_filter($arrAddress);
        foreach ($arrAddress as $key => $address) {
            $str .= " (tbl_pin_district.txt_district_name LIKE '%" . $address . "%' OR "
                    . "tbl_address.txt_state_name LIKE '%" . $address . "%' OR "
                    . "tbl_pin_district.int_pincode LIKE '%" . $address . "%') AND ";
        }
        $str = preg_replace('/\W\w+\s*(\W*)$/', '$1', $str);
    }
    if (empty($str)) {
        $str = " (tbl_pin_district.txt_district_name LIKE '%" . $address . "%' OR "
                . "tbl_pin_district.int_pincode LIKE '%" . $address . "%') ";
    }
    $query = "SELECT DISTINCT tbl_pin_district.txt_district_name, tbl_address.txt_state_name, tbl_pin_district.int_pincode"
            . " FROM tbl_pin_district ,tbl_address "
            . "WHERE tbl_address.txt_district_name = tbl_pin_district.txt_district_name AND $str"
            . "ORDER BY tbl_pin_district.txt_district_name $limit";
//    echo '<pre>';print_r($query);exit;
    $result = $utilities->selectQuery($query);
    return $result;
}

/*
 * get Result Address Of Given Loaction
 */
function getResultAddressOfGivenLoaction($arrPost){
    if(!empty($location = $arrPost['location'])){
        $removeLimit = 1;
        if(strpos($location, " - ") !== false){
            $location = str_replace(" - ", " ", $location);
        } else if(strpos($location, " -") !== false){
            $location = str_replace(" - ", " ", $location);
        } else if(strpos($location, "- ") !== false){
            $location = str_replace(" - ", " ", $location);
        } else if(strpos($location, "-") !== false){
            $location = str_replace(" - ", " ", $location);
        }
        $result = getFullAddress($location, $removeLimit);
        if($result->num_rows > 0){
            while($rows = $result->fetch_array()){
                $arrDistrictName[] = $rows['txt_district_name'];
                $arrPinCode[] = $rows['int_pincode'];
            }
            $queryLocation = "SELECT tbl_address.txt_district_name, tbl_address.txt_state_name, tbl_address.txt_number, tbl_pin_district.txt_sub_office, "
                    . "tbl_pin_district.txt_head_office, tbl_pin_district.ysn_delivery, tbl_pin_district.ysn_pickup, tbl_pin_district.int_pincode "
                    . " FROM tbl_address, tbl_pin_district WHERE "
                    . "tbl_pin_district.txt_district_name = tbl_address.txt_district_name AND "
                    . "tbl_address.txt_district_name IN ("."'" . str_replace(",", "','", implode(',',$arrDistrictName)) . "'".") AND "
                    . "tbl_pin_district.int_pincode IN ("."'" . str_replace(",", "','", implode(',',$arrPinCode)) . "'".") "
                    . "ORDER BY tbl_pin_district.int_pincode";
            $utilities = new Utilities();
//            echo '<pre>';print_r($rows);exit;
            $result = $utilities->selectQuery($queryLocation);
            return $result;
        }
        
    }
}
