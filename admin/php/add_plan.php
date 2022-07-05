<?php

require_once '../../conn/conn.php';

$facility_name          = $_POST['facility_name'];
$facility_type          = $_POST['facility_type'];
$facility_location      = $_POST['facility_location'];
$facility_block         = $_POST['facility_block'];
$floor_name             = $_POST['floor_name'];
$room_type              = $_POST['room_type'];
$plan_info_one          = $_POST['plan_info_one'];
$plan_info_two          = $_POST['plan_info_two'];
$price                  = $_POST['price'];
$gender                 = $_POST['gender'];

$sql = 'insert into plans set facility_name = ?, facility_type = ?, facility_location = ?, facility_block = ?, floor_name = ?, room_type = ?, plan_info_one = ?, plan_info_two = ?, price = ?, gender = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('ssssssssss', $facility_name, $facility_type, $facility_location, $facility_block, $floor_name, $room_type, $plan_info_one, $plan_info_two, $price, $gender);

if($sql->execute()) {
    echo 'success';
}


else echo "error";