
/*
 * get time and date
 */
function getTimeAndDate() {
    to = $(".to").val();
    from = $(".from").val();
    weight = $(".weight").val();
    bookingDate = $(".bookingDate").val();
//                alert(to);
    dateEntered = new Date(bookingDate.split("-")[0], bookingDate.split("-")[1] - 1, bookingDate.split("-")[2]);
    var date = new Date();
    today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
//                alert(dateEntered+"\n"+today);
    if (to.length > 0 && to.length != 0 && from.length > 0 && from.length != 0 && weight.length > 0 && weight.length != 0 && bookingDate.length > 0 && bookingDate.length != 0) {
        if (dateEntered >= today) {
            $(".requiredFields").removeClass("animation");
            $.ajax({
                url: "../code/ajaxRequest.php?action=timeAndPrice",
                type: 'POST',
                dataType: 'JSON',
                data: {to: to, from: from, weight: weight, bookingDate: bookingDate},
                beforeSend: function () {
                    // Show image container
                    $(".handle-spinner").show();
                },
                success: function (result) {
                    $(".table-data-content").removeAttr("hidden", "");
                    $("#documentPrice").html(result['documentPrice']);
                    $("#documentDate").html(result['documentDeliveryDate']);
                    $("#airPrice").html(result['airPrice']);
                    $("#airDate").html(result['airDeliveryDate']);
                    $("#groundPrice").html(result['groundPrice']);
                    $("#groundDate").html(result['groundDeliveryDate']);
                    if (result == "ERROR") {
                        alert(result);
                    }
                },
                complete: function (result) {
                    // Hide image container
                    $(".handle-spinner").hide();
                },
                statusCode: {
                    404: function () {
                        alert("Something went wrong");
                    }
                }
            });
        } else {
            alert("Booking date is earlier than today.");
        }
    } else {
        $(".requiredFields").addClass("animation");
    }
}

/*
 * hide table and details associated
 */
function hideTable() {
    $(".table-data-content").attr("hidden", "");

}

/*
 * getAddressData()
 */
function getFromAddressData(from) {
    $(".from").val(trimTheInput(from));
    $.ajax({
        url: "../code/ajaxRequest.php?action=from",
        type: 'POST',
//                    dataType: 'JSON',
        data: {from: from},
        beforeSend: function () {
            // Show image container
//                        $(".handle-spinner").show();
        },
        success: function (result) {
//                alert(result);
            $(".from-box").show();
            $(".from-box").html(result);
            $(".from").css("background", "#FFF");
            if (result == "ERROR") {
            }
        },
        complete: function (result) {
            // Hide image container
            $(".handle-spinner").hide();
        },
        statusCode: {
            404: function () {
                alert("Something went wrong");
            }
        }
    });
}

/*
 * getAddressData()
 */
function getToAddressData(to) {
    $(".to").val(trimTheInput(to));
    $.ajax({
        url: "../code/ajaxRequest.php?action=to",
        type: 'POST',
//                    dataType: 'JSON',
        data: {to: to},
        beforeSend: function () {
            // Show image container
//                        $(".handle-spinner").show();
        },
        success: function (result) {
            $("#to-box").show();
            $("#to-box").html(result);
            $(".to").css("background", "#FFF");
            if (result == "ERROR") {
            }
        },
        complete: function (result) {
            // Hide image container
            $(".handle-spinner").hide();
        },
        statusCode: {
            404: function () {
                alert("Something went wrong");
            }
        }
    });
}

function selectFrom(val) {
    $("#from").val(val);
    $("#from-box").hide();
}

function selectTo(val) {
    $("#to").val(val);
    $("#to-box").hide();
}

/*
 * trim function value
 */
function trimTheInput(text) {
    return text.replace(/ +(?= )/g, '');
}

/*
 * document 
 */
function shipAsDocument() {
    $action = $("#book-courier-package-form").attr("action");
    $documentPrice = $("#documentPrice").text();
    $documentDate = $("#documentDate").text();
    $action = $action + "&service=Document&deliveryDate=" + $documentDate + "&price=" + $documentPrice;
    $("#book-courier-package-form").attr("action", $action);
    $("#book-courier-package-form").submit();
}
/*
 * ship by Air 
 */
function shipByAir() {
    $action = $("#book-courier-package-form").attr("action");
    $airPrice = $("#airPrice").text();
    $airDate = $("#airDate").text();
    $action = $action + "&service=Air&deliveryDate=" + $airDate + "&price=" + $airPrice;
    $("#book-courier-package-form").attr("action", $action);
    $("#book-courier-package-form").submit();
}
/*
 * ship by Ground
 */
function shipByGround() {
    $action = $("#book-courier-package-form").attr("action");
    $groundPrice = $("#groundPrice").text();
    $groundDate = $("#groundDate").text();
    $action = $action + "&service=Ground&deliveryDate=" + $groundDate + "&price=" + $groundPrice;
    $("#book-courier-package-form").attr("action", $action);
    $("#book-courier-package-form").submit();
}

/*
 * get-booked-courier-data
 */
function getBookedCourierData() {
    $(document).on("click", ".data-edit", function () {
        var courierId = $(this).attr("id");
        $.ajax({
            url: 'code/u-ajaxRequest.php?action=get-booked-courier-data',
            method: 'POST',
            data: {courierId: courierId},
            dataType: 'json',
            success: function (data) {
                $('#int_courier_booking_id').val(data.int_courier_booking_id);
                $('#senderName').val(data.txt_sender_name);
                $('#senderNumber').val(data.txt_sender_mobile);
                $('#senderEmail').val(data.txt_sender_email);
                $('#senderAddressLine1').val(data.txt_sender_address_line1);
                $('#origin').val(data.txt_origin);
                $('#courierItem').val(data.txt_courier_item_content);
                $('#courierWeight').val(data.txt_weight);
                $('#courierItemPieces').val(data.int_courier_item_pieces);
                $('#recipientName').val(data.txt_recipient_name);
                $('#recipientNumber').val(data.txt_recipient_mobile);
                $('#recipientAlternativeNumber').val(data.txt_recipient_alternate_mobile);
                $('#recipientEmail').val(data.txt_recipient_email);
                $('#recipientAddressLine1').val(data.txt_recipient_address_line1);
                $('#destination').val(data.txt_destination);
                $('#dateBooked').val(data.dat_booked);
                $('#serviceType').val(data.txt_transport_mode);
                $('#courierStatus').val(data.txt_courier_status);
                $('#updateCourierPackage').modal('show');
            }
        });
    });
}

/*
 * get-booked-courier-data
 */
function getBookedCourierDataInView() {
    $(document).on("click", ".data-view", function () {
        var courierId = $(this).attr("id");
        $.ajax({
            url: 'code/u-ajaxRequest.php?action=get-booked-courier-data',
            method: 'POST',
            data: {courierId: courierId},
            dataType: 'json',
            success: function (data) {
                $('.int_courier_booking_id').val(data.int_courier_booking_id);
                $('.senderName').val(data.txt_sender_name);
                $('.senderNumber').val(data.txt_sender_mobile);
                $('.senderEmail').val(data.txt_sender_email);
                $('.senderAddressLine1').val(data.txt_sender_address_line1);
                $('.origin').val(data.txt_origin);
                $('.courierItem').val(data.txt_courier_item_content);
                $('.courierWeight').val(data.txt_weight);
                $('.courierItemPieces').val(data.int_courier_item_pieces);
                $('.recipientName').val(data.txt_recipient_name);
                $('.recipientNumber').val(data.txt_recipient_mobile);
                $('.recipientAlternativeNumber').val(data.txt_recipient_alternate_mobile);
                $('.recipientEmail').val(data.txt_recipient_email);
                $('.recipientAddressLine1').val(data.txt_recipient_address_line1);
                $('.destination').val(data.txt_destination);
                $('.dateBooked').val(data.dat_booked);
                $('.txt_service_type').val(data.txt_transport_mode);
                $('.courierStatus').val(data.txt_courier_status);
                $('#viewCourierPackage').modal('show');
            }
        });
    });
}

/*
 * get-booked-courier-data
 */
function deleteBookedCourierData(courierId) {
    var res = confirm("Are you sure to delete this item?");
    if (res) {
        window.location.href = "code/u-ajaxRequest.php?action=delete-booked-courier-data&courierId=" + courierId;
    }
}

/*
 * validate name
 */
function validateName(txt) {
    res = "";
    var re = /^([A-Za-z\.]{3,})$/;
    if (re.test(txt) == false) {
        res = "Min. 3 characters and only .(dot) is allowed.";
        $(".submit").attr("disabled", "");
    } else {
        res = "";
        $(".submit").removeAttr("disabled");
    }
    $(".name-validation").html(res);
    return res;
}


/*
 * validate name
 */
function validateUpdateName(txt) {
    res = "";
    var re = /^([A-Za-z\. ]{3,})$/;
    if (re.test(txt) == false) {
        res = "Min. 3 characters and only .(dot) is allowed.";
        $(".submit").attr("disabled", "");
    } else {
        res = "";
        $(".submit").removeAttr("disabled");
    }
    $(".number-update-pieces").html(res);
    return res;
}


/*
 * validate recipient name
 */
function validateRecipientName(txt) {
    res = "";
    var re = /^([A-Za-z\.]{3,})$/;
    if (re.test(txt) == false) {
        res = "Min. 3 characters and only .(dot) is allowed.";
        $(".submit").attr("disabled", "");
    } else {
        res = "";
        $(".submit").removeAttr("disabled");
    }
    $(".name-recipient-validation").html(res);
    return res;
}

/*
 * validate recipient name
 */
function validateUpdateRecipientName(txt) {
    res = "";
    var re = /^([A-Za-z\.]{3,})$/;
    if (re.test(txt) == false) {
        res = "Min. 3 characters and only .(dot) is allowed.";
        $(".submit").attr("disabled", "");
    } else {
        res = "";
        $(".submit").removeAttr("disabled");
    }
    $(".name-update-recipient-validation").html(res);
    return res;
}


/*
 * validate sender name
 */
function validateSenderName(txt) {
    res = "";
    var re = /^([A-Za-z\.]{3,})$/;
    if (re.test(txt) == false) {
        res = "Min. 3 characters and only .(dot) is allowed.";
        $(".submit").attr("disabled", "");
    } else {
        res = "";
        $(".submit").removeAttr("disabled");
    }
    $(".name-sender-validation").html(res);
    return res;
}

/*
 * validate sender name
 */
function validateUpdateSenderName(txt) {
    res = "";
    var re = /^([A-Za-z\.]{3,})$/;
    if (re.test(txt) == false) {
        res = "Min. 3 characters and only .(dot) is allowed.";
        $(".submit").attr("disabled", "");
    } else {
        res = "";
        $(".submit").removeAttr("disabled");
    }
    $(".update-name-sender-validation").html(res);
    return res;
}

/*
 * validate sender number
 */
function validateSenderNumber(txt) {
    var res = '';
    // check length of the number
    if (txt.length == 10) {
        // check the first digit of the number (6,7,8,9 only)
        mod = (Math.floor((txt / 1000000000) % 10));
        if (mod < 6) {
            //	print error message for invalid number
            res = "Please enter a valid number.";
            $(".submit").attr("disabled", "");
        } else {
            $(".submit").removeAttr("disabled");
        }
    } else if (txt.length == 0) {
        res = "";
        $(".submit").removeAttr("disabled");
    } else {
        // print error message for invalid length
        res = "Please enter a valid number.";
        $(".submit").attr("disabled", "");
    }
    $(".number-sender-validation").html(res);
}

/*
 * validate recipient number
 */
function validateRecipientNumber(txt) {
    var res = '';
    // check length of the number
    if (txt.length == 10) {
        // check the first digit of the number (6,7,8,9 only)
        mod = (Math.floor((txt / 1000000000) % 10));
        if (mod < 6) {
            //	print error message for invalid number
            res = "Please enter a valid number.";
            $(".submit").attr("disabled", "");
        } else {
            $(".submit").removeAttr("disabled");
        }
    } else if (txt.length == 0) {
        res = "";
        $(".submit").removeAttr("disabled");
    } else {
        // print error message for invalid length
        res = "Please enter a valid number.";
        $(".submit").attr("disabled", "");
    }
    $(".number-recipient-validation").html(res);
}

/*
 * validate recipient number
 */
function validateRecipientUpdateNumber(txt) {
    var res = '';
    // check length of the number
    if (txt.length == 10) {
        // check the first digit of the number (6,7,8,9 only)
        mod = (Math.floor((txt / 1000000000) % 10));
        if (mod < 6) {
            //	print error message for invalid number
            res = "Please enter a valid number.";
            $(".submit").attr("disabled", "");
        } else {
            $(".submit").removeAttr("disabled");
        }
    } else if (txt.length == 0) {
        res = "";
        $(".submit").removeAttr("disabled");
    } else {
        // print error message for invalid length
        res = "Please enter a valid number.";
        $(".submit").attr("disabled", "");
    }
    $(".number-update-recipient-validation").html(res);
}

/*
 * validate Update recipient number
 */
function validateUpdateSenderNumber(txt) {
    var res = '';
    // check length of the number
    if (txt.length == 10) {
        // check the first digit of the number (6,7,8,9 only)
        mod = (Math.floor((txt / 1000000000) % 10));
        if (mod < 6) {
            //	print error message for invalid number
            res = "Please enter a valid number.";
            $(".submit").attr("disabled", "");
        } else {
            $(".submit").removeAttr("disabled");
        }
    } else if (txt.length == 0) {
        res = "";
        $(".submit").removeAttr("disabled");
    } else {
        // print error message for invalid length
        res = "Please enter a valid number.";
        $(".submit").attr("disabled", "");
    }
    $(".update-number-sender-validation").html(res);
}

/*
 * validate recipient number
 */
function validateRecipientAlternateNumber(txt) {
    var res = '';
    // check length of the number
    if (txt.length == 10) {
        // check the first digit of the number (6,7,8,9 only)
        mod = (Math.floor((txt / 1000000000) % 10));
        if (mod < 6) {
            //	print error message for invalid number
            res = "Please enter a valid number.";
            $(".submit").attr("disabled", "");
        } else {
            $(".submit").removeAttr("disabled");
        }
    } else if (txt.length == 0) {
        res = "";
        $(".submit").removeAttr("disabled");
    } else {
        // print error message for invalid length
        res = "Please enter a valid number.";
        $(".submit").attr("disabled", "");
    }
    $(".alternate-number-recipient-validation").html(res);
}

/*
 * validate recipient number
 */
function validateRecipientUpdateAlternateNumber(txt) {
    var res = '';
    // check length of the number
    if (txt.length == 10) {
        // check the first digit of the number (6,7,8,9 only)
        mod = (Math.floor((txt / 1000000000) % 10));
        if (mod < 6) {
            //	print error message for invalid number
            res = "Please enter a valid number.";
            $(".submit").attr("disabled", "");
        } else {
            $(".submit").removeAttr("disabled");
        }
    } else if (txt.length == 0) {
        res = "";
        $(".submit").removeAttr("disabled");
    } else {
        // print error message for invalid length
        res = "Please enter a valid number.";
        $(".submit").attr("disabled", "");
    }
    $(".alternate-number-update-recipient-validation").html(res);
}



/*
 * validate email
 */
function validateSenderEmail(txt) {
    res = "";
    var re = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (re.test(txt) == false) {
        res = "Please enter a valid email.";
        $(".submit").attr("disabled", "");
    } else {
        res = "";
        $(".submit").removeAttr("disabled");
    }
    $(".email-sender-validation").html(res);
    return res;
}
 
/*
 * validate update-email-sender
 */
function validateUpdateRecipientEmail(txt) {
    res = "";
    var re = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (re.test(txt) == false) {
        res = "Please enter a valid email.";
        $(".submit").attr("disabled", "");
    } else {
        res = "";
        $(".submit").removeAttr("disabled");
    }
    $(".update-email-sender-validation").html(res);
    return res;
}
        
/*
 * validate email
 */
function validateRecipientEmail(txt) {
    res = "";
    var re = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (re.test(txt) == false) {
        res = "Please enter a valid email.";
        $(".submit").attr("disabled", "");
    } else {
        res = "";
        $(".submit").removeAttr("disabled");
    }
    $(".email-recipient-validation").html(res);
    return res;
}

/*
 * validate email
 */
function validateUpdateRecipientEmail(txt) {
    res = "";
    var re = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (re.test(txt) == false) {
        res = "Please enter a valid email.";
        $(".submit").attr("disabled", "");
    } else {
        res = "";
        $(".submit").removeAttr("disabled");
    }
    $(".email-update-recipient-validation").html(res);
    return res;
}

/*
 * validate city
 */
function validateCity(txt) {
    res = "";
    var re = /^([A-Za-z]{3,})$/;
    if (re.test(txt) == false) {
        res = "Min. 3 characters and no space is allowed.";
        $(".submit").attr("disabled", "");
    } else {
        res = "";
        $(".submit").removeAttr("disabled");
    }
    $(".city-validation").html(res);
    return res;
}



/*
 * validate city
 */
function validateState(txt) {
    res = "";
    var re = /^([A-Za-z\. ]{3,})$/;
    if (re.test(txt) == false) {
        res = "Min. 3 characters and only .(dot) is allowed.";
        $(".submit").attr("disabled", "");
    } else {
        res = "";
        $(".submit").removeAttr("disabled");
    }
    $(".state-validation").html(res);
    return res;
}



       