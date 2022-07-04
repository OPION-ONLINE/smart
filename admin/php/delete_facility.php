<?php

require_once '../../conn/conn.php';

$facility_name          = $_POST['facility_name'];
$facility_type          = $_POST['facility_type'];
$facility_location      = $_POST['facility_location'];

$sql = 'select * from facilities where facility_name = ? and facility_type = ? and facility_location = ?';
// echo "select * from blocks where facility_block = '$facility_block' and facility_name = '$facility_name' and facility_type = '$facility_type' and facility_location = '$facility_location'";
$sql = $conn->prepare($sql);
$sql->bind_param('sss',   $facility_name, $facility_type, $facility_location);
$sql->execute();
$result = $sql->get_result();

if($result->num_rows > 0) {

$sql = 'delete  from plans where   facility_name = ? and facility_type = ? and facility_location = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sss', $facility_name, $facility_type, $facility_location);
$sql->execute();

$sql = 'delete  from rooms where   facility_name = ? and facility_type = ? and facility_location = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sss', $facility_name, $facility_type, $facility_location);
$sql->execute();

$sql = 'delete  from floors where   facility_name = ? and facility_type = ? and facility_location = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sss', $facility_name, $facility_type, $facility_location);
$sql->execute();

$sql = 'delete  from blocks where   facility_name = ? and facility_type = ? and facility_location = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sss', $facility_name, $facility_type, $facility_location);
$sql->execute();

$sql = 'delete  from facilities where   facility_name = ? and facility_type = ? and facility_location = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sss', $facility_name, $facility_type, $facility_location);


if($sql->execute()) {
    echo 'success';
}

else echo "error";

} else echo "error";