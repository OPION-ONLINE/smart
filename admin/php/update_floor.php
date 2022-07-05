<?php

require_once '../../conn/conn.php';

$facility_name          = $_POST['facility_name'];
$facility_type          = $_POST['facility_type'];
$facility_location      = $_POST['facility_location'];
$facility_block         = $_POST['facility_block'];
$floor_name             = $_POST['floor_name'];
$old_floor              = $_POST['old_floor'];

$sql = 'select * from floors where facility_block = ? and facility_name = ? and facility_type = ? and facility_location = ? and floor_name = ?';
// echo "select * from blocks where facility_block = '$facility_block' and facility_name = '$facility_name' and facility_type = '$facility_type' and facility_location = '$facility_location'";
$sql = $conn->prepare($sql);
$sql->bind_param('sssss',  $facility_block, $facility_name, $facility_type, $facility_location, $floor_name);
$sql->execute();
$result = $sql->get_result();

if($result->num_rows > 0) {
    echo "error";
    exit();
}

$sql = 'update  plans set floor_name = ? where facility_name = ? and facility_type = ? and facility_location = ? and facility_block = ? and floor_name = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('ssssss', $floor_name, $facility_name, $facility_type, $facility_location, $facility_block, $old_floor);
$sql->execute();

$sql = 'update floors set floor_name = ? where facility_block = ? and facility_name = ? and facility_type = ? and facility_location = ? and floor_name = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('ssssss',  $floor_name, $facility_block, $facility_name, $facility_type, $facility_location, $old_floor);
$sql->execute();

$sql = 'update rooms set floor_name = ? where facility_block = ? and facility_name = ? and facility_type = ? and facility_location = ? and floor_name = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('ssssss',  $floor_name, $facility_block, $facility_name, $facility_type, $facility_location, $old_floor);

if($sql->execute()) {
    echo 'success';
}


else echo "error";
