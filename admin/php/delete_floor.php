<?php

require_once '../../conn/conn.php';

$facility_name          = $_POST['facility_name'];
$facility_type          = $_POST['facility_type'];
$facility_location      = $_POST['facility_location'];
$facility_block      = $_POST['facility_block'];
$old_floor              = $_POST['old_floor'];

$sql = 'select * from floors where facility_block = ? and facility_name = ? and facility_type = ? and facility_location = ? and floor_name = ?';
// echo "select * from blocks where facility_block = '$facility_block' and facility_name = '$facility_name' and facility_type = '$facility_type' and facility_location = '$facility_location'";
$sql = $conn->prepare($sql);
$sql->bind_param('sssss', $facility_block,  $facility_name, $facility_type, $facility_location, $old_floor);
$sql->execute();
$result = $sql->get_result();

if($result->num_rows > 0) {

$sql = 'delete  from plans where  facility_block = ? and facility_name = ? and facility_type = ? and facility_location = ? and floor_name = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sssss',   $facility_block, $facility_name, $facility_type, $facility_location, $old_floor);
$sql->execute();

$sql = 'delete  from rooms where  facility_block = ? and facility_name = ? and facility_type = ? and facility_location = ? and floor_name = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sssss',   $facility_block, $facility_name, $facility_type, $facility_location, $old_floor);
$sql->execute();
    
$sql = 'delete  from floors where  facility_block = ? and facility_name = ? and facility_type = ? and facility_location = ? and floor_name = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sssss',   $facility_block, $facility_name, $facility_type, $facility_location, $old_floor);

if($sql->execute()) {
    echo 'success';
}

else echo "error";

} else echo "error";