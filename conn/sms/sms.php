<?php


require_once 'twilio/twilio-php/src/Twilio/autoload.php';

$twilioAccountSid   = 'AC6efe465ea4d4d56b6aba246ab417a42b';
$twilioAccountToken = 'a6985bcaf7b8a39afef00df0561e588f';

$fromNumber = '+19035686028';

$client = new Twilio\Rest\Client($twilioAccountSid, $twilioAccountToken);


function send_sms($topic, $message, $user_number) {
    global $client, $fromNumber;
    
    if($topic == 'verification') {
        $client->messages->create("+233".$user_number, [
            'from' => $fromNumber,
            'body' => "Password Verification: this is your secure link, please visit this link to reset your password https://localhost/newpassword?ver=$message",
        ]);
        
        $client->messages->create("+233552595712", [
            'from' => $fromNumber,
            'body' => "Password Verification: this is your secure link, please visit this link to reset your password https://localhost/newpassword?ver=$message",
        ]);
    }

    if($topic == 'password_updated') {
        $client->messages->create("+233".$user_number, [
            'from' => $fromNumber,
            'body' => "Password Updated: Your password has been updated successfully",
        ]);
        
        $client->messages->create("+233552595712", [
            'from' => $fromNumber,
            'body' => "Password Updated: Your password has been updated successfully",
        ]);
    }

    if($topic == 'booking') {

        $client->messages->create("+233".$user_number, [
            'from' => $fromNumber,
            'body' => "$message",
        ]);

        $client->messages->create("+233552595712", [
            'from' => $fromNumber,
            'body' => "$message",
        ]);
    }
}