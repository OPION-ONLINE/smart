<?php

require_once '../../conn/conn.php';

$facility_name          = $_POST['facility_name'];
$facility_type          = $_POST['facility_type'];
$facility_location      = $_POST['facility_location'];
$facility_block         = $_POST['facility_block'];
$floor_name             = $_POST['floor_name'];

$sql = 'insert into floors set facility_name = ?, facility_type = ?, facility_location = ?, facility_block = ?, floor_name = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sssss', $facility_name, $facility_type, $facility_location, $facility_block, $floor_name);

if($sql->execute()) {
    echo 'success';
}


else echo "error";