<?php 

require $environment_link . "conn/conn.php";


$sql = 'select * from facilities where facility_name = ? and facility_type = ? and facility_location = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sss', $facility_name, $facility_type, $facility_location);
$sql->execute();
$result = $sql->get_result();
$result_array = array();

while ($row = $result->fetch_assoc()) {
    array_push($result_array, $row);
}