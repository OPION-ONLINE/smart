<?php

require_once '../conn.php';

$facility_name          = $_POST['facility_name'];
$facility_type          = $_POST['facility_type'];
$facility_location      = $_POST['facility_location'];
$selected_block         = $_POST['selected_block'];
$selected_floor         = $_POST['selected_floor'];
$selected_room          = $_POST['selected_room'];
$selected_gender        = $_POST['selected_gender'];

$sql = 'select * from plans where facility_name = ? and facility_type = ? and facility_location = ? and facility_block = ? and floor_name = ? and room_type = ? and gender = ?';
// echo "select * from plans where facility_name = '$facility_name' and facility_type = '$facility_type' and facility_location = '$facility_location' and facility_block = '$selected_block' and floor_name = '$selected_floor' and room_type = '$selected_room' and gender = '$selected_gender'";
$sql = $conn->prepare($sql);
$sql->bind_param('sssssss', $facility_name, $facility_type, $facility_location, $selected_block, $selected_floor, $selected_room, $selected_gender);
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