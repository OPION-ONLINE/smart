<?php

require_once '../../conn/conn.php';

$start_id      = $_POST['start_id'];
$limit         = $_POST['limit'];
$start_date    = $_POST['start_date'];
$end_date      = $_POST['end_date'];


$sql           = "select * from facilities where id > ? and facility_date >= ? and facility_date <= ? limit ?;";
// echo "select * from facilities where id > $start_id and facility_date >= '$start_date' and facility_date <= '$end_date' limit $limit;";
$command       = $conn->prepare($sql);
$command->bind_param('issi', $start_id, $start_date, $end_date, $limit);
$command->execute();

$result_array = array();
$result       = $command->get_result();

//add result to array
while($row = $result->fetch_assoc()) {
    array_push($result_array, $row);
}

header('Content-Type: application/json');
echo json_encode($result_array);