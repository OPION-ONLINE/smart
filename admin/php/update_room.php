<?php

require_once '../../conn/conn.php';

$facility_name          = $_POST['facility_name'];
$facility_type          = $_POST['facility_type'];
$facility_location      = $_POST['facility_location'];
$facility_block         = $_POST['facility_block'];
$floor_name             = $_POST['floor_name'];
$room_type              = $_POST['room_type'];
$old_room             = $_POST['old_room'];
$old_gender           = $_POST['old_gender'];
$room_count             = $_POST['room_count'];
$gender                 = $_POST['gender'];
$outer_image            = $_POST['outer_image'];
$room_image             = $_POST['room_image'];
$lavatory_image         = $_POST['lavatory_image'];

$sql = 'select * from rooms where facility_block = ? and facility_name = ? and facility_type = ? and facility_location = ? and floor_name = ? and room_type = ? and gender = ?';
// echo "select * from blocks where facility_block = '$facility_block' and facility_name = '$facility_name' and facility_type = '$facility_type' and facility_location = '$facility_location'";
$sql = $conn->prepare($sql);
$sql->bind_param('sssssss',  $facility_block, $facility_name, $facility_type, $facility_location, $floor_name, $room_type, $gender);
$sql->execute();
$result = $sql->get_result();

if($result->num_rows > 0 && $old_gender != $gender && $old_room != $room_type) {
    echo "error";
    exit();
}

$sql = 'update  plans set room_type = ? where facility_name = ? and facility_type = ? and facility_location = ? and facility_block = ? and floor_name = ? and room_type = ? and gender = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('ssssssss', $room_type, $facility_name, $facility_type, $facility_location, $facility_block, $floor_name, $old_room, $old_gender);
$sql->execute();

$sql = 'update rooms set room_type = ?, room_count = ?, gender = ?, outer_image = ?, room_image = ?, lavatory_image = ?
 where facility_block = ? and facility_name = ? and facility_type = ? and facility_location = ? and floor_name = ? and room_type = ? and gender = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sssssssssssss', $room_type, $room_count, $gender, $outer_image, $room_image, $lavatory_image, $facility_block, $facility_name, $facility_type, $facility_location, $floor_name, $old_room, $old_gender);

if($sql->execute()) {
    echo 'success';
}


else echo "error";
