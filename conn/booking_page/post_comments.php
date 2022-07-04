<?php

require_once '../conn.php';

$facility_name          = $_POST['facility_name'];
$facility_type          = $_POST['facility_type'];
$facility_location      = $_POST['facility_location'];
$username               = $_POST['username'];
$usernumber             = $_POST['usernumber'];
$comment                = $_POST['comment'];

$sql = 'select * from booking where facility_name = ? and facility_type = ? and facility_location = ? and user_name = ? and user_number = ? order by id desc limit 1';
$sql = $conn->prepare($sql);
$sql->bind_param('sssss', $facility_name, $facility_type, $facility_location, $username, $usernumber);
$sql->execute();

$result = $sql->get_result()->fetch_assoc();


$date = $result['booking_date'];

$current = strtotime(date("Y-m-d H:i:s"));
$date= strtotime($date);
$howLong = abs($date - $current) / 60 / 60 / 60 / 24;
$howLong = (int) $howLong;

if( $howLong >= 30) {
    $sql = 'insert into comments set facility_name = ?, facility_type = ?, facility_location = ?, user_name = ?, user_number = ?, comment = ?';

    $sql = $conn->prepare($sql);
    $sql->bind_param('ssssss', $facility_name, $facility_type, $facility_location, $username, $usernumber, $comment);
    $sql->execute();
    echo 'success';
    
}