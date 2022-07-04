<?php

require_once '../conn.php';

$facility_name          = $_POST['facility_name'];
$facility_type          = $_POST['facility_type'];
$facility_location      = $_POST['facility_location'];
$start_id               = $_POST['start_id'];
$limit               = $_POST['limit'];

$sql = 'select * from comments where facility_name = ? and facility_type = ? and facility_location = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sss', $facility_name, $facility_type, $facility_location);
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