<?php

require_once '../conn.php';

$input_complete = 

!isset($_POST['full_name'])             ||
!isset($_POST['phone_number'])          ||
!isset($_POST['email'])                 ||
!isset($_POST['gender'])                ||
!isset($_POST['status'])                ||
!isset($_POST['password'])              ||
!isset($_POST['confirm_password'])

;

$input_empty = 

empty($_POST['full_name'])             ||
empty($_POST['phone_number'])          ||
empty($_POST['email'])                 ||
empty($_POST['gender'])                ||
empty($_POST['status'])                ||
empty($_POST['password'])              ||
empty($_POST['confirm_password'])

;

function handle_error($error_code) {
    header("location: ../../signup?error=$error_code");
    exit();
}

if($input_complete || $input_empty) {
    handle_error('empty');
}


$full_name              = $_POST['full_name'];             
$phone_number           = $_POST['phone_number'];          
$email                  = $_POST['email'];                 
$gender                 = $_POST['gender'];                
$status                 = $_POST['status'];                
$password               = $_POST['password'];              
$confirm_password       = $_POST['confirm_password'];

$sql = 'select count(*) from users where user_number = ? or user_email = ?';
$sql = $conn->prepare($sql);

$sql->bind_param('ss', $phone_number, $email);
$sql->execute();
$result = $sql->get_result()->fetch_assoc();

if(sizeof($result) > 0) handle_error('exists');
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) handle_error('email');
if($password !== $confirm_password) handle_error('password');

$sql = 'insert into users set user_name = ?, user_email = ?, user_number = ?, user_password = ?, user_status = ?, user_gender = ?;';
$sql = $conn->prepare($sql);
$sql->bind_param('ssssss', $full_name, $phone_number, $confirm_password, $status, $gender);

if($sql->execute()) handle_error('success');


session_start();

$_SESSION['USERNAME'] = $full_name;
$_SESSION['EMAIL'] = $email;
$_SESSION['NUMBER'] = $phone_number;
$_SESSION['GENDER'] = $gender;
$_SESSION['STATUS'] = $status;


header('location: '. $_SERVER['HTTP_REFERER']);