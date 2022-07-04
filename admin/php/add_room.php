<?php

require_once '../../conn/conn.php';

$facility_name          = $_POST['facility_name'];
$facility_type          = $_POST['facility_type'];
$facility_location      = $_POST['facility_location'];
$facility_block         = $_POST['facility_block'];
$floor_name             = $_POST['floor_name'];
$room_type              = $_POST['room_type'];
$room_count             = $_POST['room_count'];
$gender                 = $_POST['gender'];
$outer_image            = $_POST['outer_image'];
$room_image             = $_POST['room_image'];
$lavatory_image         = $_POST['lavatory_image'];

$sql = 'insert into rooms set facility_name = ?, facility_type = ?, facility_location = ?, facility_block = ?, floor_name = ?, room_type = ?, room_count = ?, gender = ?, outer_image = ?, room_image = ?, lavatory_image = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sssssssssss', $facility_name, $facility_type, $facility_location, $facility_block, $floor_name, $room_type, $room_count, $gender, $outer_image, $room_image, $lavatory_image);

if($sql->execute()) {
    echo 'success';
}


else echo "error";