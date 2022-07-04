<?php

require_once "../../dataman.php";

$dataman = new Dataman();

$reference            = $_GET['reference'];
$username             = $_GET['user_name'];
$useremail            = $_GET['user_email'];
$usernumber           = $_GET['user_number'];
$facility_name        = $_GET['facility_name'];
$facility_type        = $_GET['facility_type'];
$facility_location    = $_GET['facility_location'];
$facility_floor       = $_GET['facility_floor'];
$room_type            = $_GET['room_type'];
$amount_paid          = $_GET['amount_paid'];

// echo "$username, $useremail, $usernumber, $facility_name, $facility_type, $facility_location, $facility_floor, $room_type, $reference, $amount_paid";

if($dataman->make_booking($username, $useremail, $usernumber, $facility_name, $facility_type, $facility_location, $facility_floor, $room_type, $reference, $amount_paid)) {
  // echo "booking made";
}
else {
  echo "not made";
  exit();
}

if ($reference == '') {
    header('Location: javascript://history.go(-1) ');
    exit();
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
    $status = $result->data->status;
    $ref = $result->data->reference;
    $lastname = $result->data->customer->last_name;
    $firstname = $result->data->customer->first_name;
    $fullname = $lastname . ' ' . $firstname;
    $cus_email = $result->data->customer->email;

    $dataman->verify_booking($ref);

    require_once 'send_receipt.php';
    require_once 'send_sms.php';

    //insert into db here
    echo "payment made";
  }
  else {
    echo "payment not made";
  }

?>