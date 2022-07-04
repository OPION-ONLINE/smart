<?php

require($_SERVER['DOCUMENT_ROOT'].'/me/Opion_ehostel/backend/twilio/twilio-php/src/Twilio/autoload.php');
$twilioAccountSid   = 'AC6efe465ea4d4d56b6aba246ab417a42b';
$twilioAccountToken = '5cb525a81bb24d91645eefcf5b4554be';

$fromNumber = '+19035686028';
$toNumber   = "+233$usernumber";

$client = new Twilio\Rest\Client($twilioAccountSid, $twilioAccountToken);

$client->messages->create($toNumber, [
    'from' => $fromNumber,
    'body' => "Booking Successfull. Thanks for Booking with us. BookingID: $reference, Amount Paid: $amount_paid, Name: $username, Date: $today, Type: $facility_type, Facility: $facility_name, Floor: $facility_floor, Mode Of Payment: Bank Transfere, Payment Identification: Bank Transfere",
]);

echo "message sent";