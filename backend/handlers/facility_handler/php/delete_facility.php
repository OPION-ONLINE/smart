<?php

require_once "../../dataman.php";

$dataman = new Dataman();
$facility_name = $_POST['facility_name'];
$facility_type = $_POST['facility_type'];


$facility_exists = $dataman->fetch_facility($facility_name, $facility_type);
$facility_exists = sizeof($facility_exists);

if($facility_exists > 0) {
    echo "Deleting...";
    $dataman->delete_facility($facility_name, $facility_type);
    echo $facility_name;
}

echo "Done!!";


