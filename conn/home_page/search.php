<?php


require_once '../conn.php';
$query = $_POST['query'];
$query = "%$query%";
$facility_type = $_POST['type'];

$sql = 'select * from facilities where (facility_name like ? or facility_location like ?) and facility_type = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sss', $query, $query, $facility_type);
$sql->execute();

$result = $sql->get_result();
$result_array = array();

while ($row = $result->fetch_assoc()) {
    array_push($result_array, $row);
}

header('Content-Type: application/json');
echo json_encode($result_array);