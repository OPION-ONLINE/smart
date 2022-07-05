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
$price          = $_POST['price'];
$gender         = $_POST['gender'];
$old_plan_one   = $_POST['old_plan_one'];
$old_plan_two   = $_POST['old_plan_two'];

$sql = 'select * from plans where facility_block = ? and facility_name = ? and facility_type = ? and facility_location = ? and floor_name = ? and room_type = ? and gender = ? and plan_info_one = ? and plan_info_two = ?';
// echo "select * from blocks where facility_block = '$facility_block' and facility_name = '$facility_name' and facility_type = '$facility_type' and facility_location = '$facility_location'";
$sql = $conn->prepare($sql);
$sql->bind_param('sssssssss',  $facility_block, $facility_name, $facility_type, $facility_location, $floor_name, $room_type, $gender, $plan_info_one, $plan_info_two);
$sql->execute();
$result = $sql->get_result();

if($result->num_rows > 0 && $plan_info_one != $old_plan_one && $plan_info_one != $old_plan_two) {
    echo "error";
    exit();
}

$sql = 'update  plans set plan_info_one = ?, plan_info_two = ?, price = ? where facility_name = ? and facility_type = ? and facility_location = ? and facility_block = ? and floor_name = ? and room_type = ? and gender = ? and plan_info_one = ? and plan_info_two = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('ssssssssssss', $plan_info_one, $plan_info_two, $price, $facility_name, $facility_type, $facility_location, $facility_block, $floor_name, $room_type, $gender, $plan_info_one, $plan_info_two);

if($sql->execute()) {
    echo 'success';
}


else echo "error";
