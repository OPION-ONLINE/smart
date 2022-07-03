<?php

require_once '../conn.php';

$input_complete = 


!isset($_POST['phone_number'])          ||
!isset($_POST['password'])              

;

$input_empty = 


empty($_POST['phone_number'])          ||
empty($_POST['password'])              

;

function handle_error($error_code) {
    // header("location: ../../signup?status=$error_code");
    echo $error_code;
    exit();
}

if($input_complete || $input_empty) {
    handle_error('empty');
}
           
$phone_number           = $_POST['phone_number'];         
$password               = $_POST['password'];
$password = md5($password . 'OpionOnline@OpionOnline');

$sql = 'select * from users where user_number = ? and user_password = ?';
$sql = $conn->prepare($sql);

$sql->bind_param('ss', $phone_number, $password);
$sql->execute();
$result = $sql->get_result()->fetch_assoc();

if($result > 0) {

    session_start();
    
    $_SESSION['USERNAME'] = $result['user_name'];
    $_SESSION['EMAIL'] = $result['user_email'];
    $_SESSION['NUMBER'] = $result['user_number'];
    $_SESSION['GENDER'] = $result['user_gender'];
    $_SESSION['STATUS'] = $result['user_status'];
    $_SESSION['LOGIN'] = true;
    
    handle_error('exists');
}


