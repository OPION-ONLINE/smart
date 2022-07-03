<?php

require_once '../conn.php';
require_once '../sms/sms.php';
// require_once '../mail/mail.php';


$input_complete = 

!isset($_POST['password'])             ||
!isset($_POST['confirm_password'])     ||
!isset($_GET['ver'])     

;

$input_empty = 

empty($_POST['password'])             ||
empty($_POST['confirm_password'])     ||
empty($_GET['ver'])          

;

function handle_error($error_code) {
    // header("location: ../../signup?status=$error_code");
    echo $error_code;
    exit();
}

if($input_complete || $input_empty) {
    handle_error('empty');
}


$password = $_POST['password'];             
$confirm_password = $_POST['confirm_password'];
if($password !== $confirm_password) handle_error('password');

$number = preg_match('@[0-9]@', $password);
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$specialChars = preg_match('@[^\w]@', $password);
 
if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) handle_error('weak');

$ver = $_GET['ver'];
$password = md5($password . 'OpionOnline@OpionOnline');

$sql = 'select * from verification where link = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('s', $ver);
$sql->execute();

$result = $sql->get_result();

if($result->num_rows > 0) {
    $result = $result->fetch_assoc();
    $user_name = $result['user_name'];
    $user_number = $result['user_number'];
    $date = $result['user_date'];
    

    $current = strtotime(date("Y-m-d H:i:s"));
    $date= strtotime($date);
    $howLong = abs($date - $current) / 60 / 60;
    $howLong = (int) $howLong;
    
    if( $howLong <= 30) {
        $sql = 'update users set user_password = ? where user_name = ? and user_number = ?';

        $sql = $conn->prepare($sql);
        $sql->bind_param('sss', $password, $user_name, $user_number);
        $sql->execute();

        send_sms('password_updated', '', $user_number);
        
    }

    $sql = 'delete from verification where link = ?';
    $sql = $conn->prepare($sql);
    $sql->bind_param('s', $ver);
    $sql->execute();

    handle_error('success');
}

handle_error('expired');


// header('location: '. $_SERVER['HTTP_REFERER']);