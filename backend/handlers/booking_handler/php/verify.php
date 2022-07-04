<?php

require_once "../../dataman.php";

$dataman = new Dataman();

$booking_id = $_POST['booking_id'];
$reference = $booking_id;

if ($reference == '') {
    header('Location: javascript://history.go(-1) ');
    exit();
}


  $curl = curl_init();

//   echo "reference php: ". rawurlencode($reference);

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
    
    $ref = $result->data->reference;
    $dataman->verify_booking($ref);

    //insert into db here
    echo "verified";
  }
  else {
    echo "unverified";
  }

?>