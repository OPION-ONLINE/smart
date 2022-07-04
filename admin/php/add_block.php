<?php

require_once '../../conn/conn.php';

$facility_name          = $_POST['facility_name'];
$facility_type          = $_POST['facility_type'];
$facility_location      = $_POST['facility_location'];
$facility_block         = $_POST['facility_block'];

$sql = 'insert into blocks set facility_name = ?, facility_type = ?, facility_location = ?, facility_block = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('ssss', $facility_name, $facility_type, $facility_location, $facility_block);

if($sql->execute()) {
    echo 'success';
}


else echo "error";