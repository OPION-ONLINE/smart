<?php

require_once '../../conn/conn.php';

$facility_name          = $_POST['facility_name'];
$facility_type          = $_POST['facility_type'];
$facility_location      = $_POST['facility_location'];
$facility_block             = $_POST['facility_block'];
$floor_name             = $_POST['floor_name'];
$room_type              = $_POST['room_type'];
$gender                 = $_POST['gender'];

$sql = 'select * from plans where facility_name = ? and facility_type = ? and facility_location = ? and facility_block = ? and floor_name = ? and room_type = ? and gender = ?';
// echo "select * from blocks where facility_name = '$facility_name' and facility_type = '$facility_type' and facility_location = '$facility_location' and facility_block = '$floor_name'";
$sql = $conn->prepare($sql);
$sql->bind_param('sssssss', $facility_name, $facility_type, $facility_location, $facility_block, $floor_name, $room_type, $gender);
$sql->execute();

$result = $sql->get_result();
$result_array = array();

while($row = $result->fetch_assoc()) {
    array_push($result_array, $row);
}

if(sizeof($result_array) > 0) {
    header('Content-Type: application/json');
    echo json_encode($result_array);
}
else echo "empty";