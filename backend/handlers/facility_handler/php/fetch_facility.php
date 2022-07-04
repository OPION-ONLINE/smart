<?php
require_once "../../dataman.php";

$dataman = new Dataman();
$facility_name = $_POST['facility_name'];
$facility_type = $_POST['facility_type'];
$result_array = $dataman->fetch_facility($facility_name, $facility_type);

header('Content-type: application/json');
echo json_encode($result_array);