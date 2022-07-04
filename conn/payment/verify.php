<?php

require_once "../conn.php";

$reference            = $_POST['reference'];
$username             = $_POST['username'];
$useremail            = $_POST['useremail'];
$usernumber           = $_POST['usernumber'];
$facility_name          = $_POST['facility_name'];
$facility_type          = $_POST['facility_type'];
$facility_location      = $_POST['facility_location'];
$selected_block         = $_POST['selected_block'];
$selected_floor         = $_POST['selected_floor'];
$selected_room          = $_POST['selected_room'];
$selected_gender        = $_POST['selected_gender'];
$plan                 = $_POST['selected_plan'];
$amount_paid          = $_POST['amount_paid'];

// echo "$username, $useremail, $usernumber, $facility_name, $facility_type, $facility_location, $facility_floor, $room_type, $reference, $amount_paid";



if ($reference == '') {
    header('Location: javascript://history.go(-1) ');
    exit();
}
else {
    $sql = 'insert into booking set
            user_name = ?, user_email = ?, user_number = ?,
            facility_name = ?, facility_type = ?, facility_location = ?,
            facility_block = ?, facility_floor = ?, room_type = ?, gender = ?,
            booking_id = ?, selected_plan = ?, amount_paid = ?;
    ';

    $sql = $conn->prepare($sql);

    $sql->bind_param('ssssssssssssi', 
        $username, $useremail, $usernumber, $facility_name,
        $facility_type, $facility_location, $selected_block, $selected_floor,
        $selected_room, $selected_gender, $reference, $plan, $amount_paid
    );

    $sql->execute();
}


  $curl = curl_init();

  // echo "reference php: ". rawurlencode($reference);

  curl_setopt_array($curl, array(

    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),

    CURLOPT_RETURNTRANSFER => true,

    CURLOPT_ENCODING => "",

    CURLOPT_MAXREDIRS => 10,

    CURLOPT_TIMEOUT => 30,

    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

    CURLOPT_CUSTOMREQUEST => "GET",

    CURLOPT_HTTPHEADER => array(

      "Authorization: Bearer sk_test_97e6b44638ab7e2a1498fb95507d1cb9b7cef750",

      "Cache-Control: no-cache",

    ),

  ));

  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);


  if ($err) {

    echo "cURL Error #:" . $err;

  } else {

    // echo $response;
    $result = json_decode($response);

    // echo $response;

  }

  if($result->data->status == 'success') {
    $channel = $result->data->channel;

    $sql = 'update booking set
            user_name = ?, user_email = ?, user_number = ?,
            facility_name = ?, facility_type = ?, facility_location = ?,
            facility_block = ?, facility_floor = ?, room_type = ?, gender = ?,
            selected_plan = ?, amount_paid = ?, payment_verification = "verified" where booking_id = ?';
    ;

    $sql = $conn->prepare($sql);

    $sql->bind_param('sssssssssssis', 
        $username, $useremail, $usernumber, $facility_name,
        $facility_type, $facility_location, $selected_block, $selected_floor,
        $selected_room, $selected_gender, $plan, $amount_paid, $reference
    );

    $sql->execute();

    $today = date("F j, Y, g:i a"); 

    require_once 'send_receipt.php';
    require_once '../sms/sms.php';


    send_sms('booking', "Booking Successfull. Thanks for Booking with us. BookingID: $reference, Amount Paid: $amount_paid, Name: $username, Date: $today, Type: $facility_type, Facility: $facility_name, Floor: $selected_floor, Mode Of Payment: $channel, Plan: $plan", $usernumber);

    //insert into db here
    echo "payment made";
  }
  else {
    echo "payment not made";
  }

?>