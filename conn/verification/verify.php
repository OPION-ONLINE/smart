<?php

require_once '../conn.php';
require_once '../sms/sms.php';
// require_once '../mail/mail.php';


$input_complete = 

!isset($_POST['full_name'])             ||
!isset($_POST['phone_number'])          

;

$input_empty = 

empty($_POST['full_name'])             ||
empty($_POST['phone_number'])          

;

function handle_error($error_code) {
    // header("location: ../../signup?status=$error_code");
    echo $error_code;
    exit();
}

if($input_complete || $input_empty) {
    handle_error('empty');
}


$full_name              = $_POST['full_name'];             
$phone_number           = $_POST['phone_number'];

$sql = 'select * from users where user_number = ? or user_name = ?';
$sql = $conn->prepare($sql);

$sql->bind_param('ss', $phone_number, $full_name);
$sql->execute();
$result = $sql->get_result();

if($result->num_rows > 0) {

    
    
    $link = md5($full_name . $phone_number . 'OpionV35!f!6ation');

    $sql = 'delete from verification where link = ?';
    $sql = $conn->prepare($sql);
    $sql->bind_param('s', $llink);
    $sql->execute();

    $sql = 'insert into verification set user_name = ?, user_number = ?, link = ?';
    $sql = $conn->prepare($sql);
    $sql->bind_param('sss', $full_name, $phone_number, $link);
    $sql->execute();

    // send_mail('verfication', $link);
    send_sms('verification', $link, $phone_number);
    echo $link;
    handle_error('sent');
}


header('location: '. $_SERVER['HTTP_REFERER']);