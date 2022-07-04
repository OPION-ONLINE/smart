<?php

require_once "../../dataman.php";

$dataman = new Dataman();
$facility = $_POST['facility'];
$facility = json_decode($facility, true);

echo $facility['facility_name'];
echo $facility['facility_type'];

$facility_exists = $dataman->fetch_facility($facility['facility_name'], $facility['facility_type']);
$facility_exists = sizeof($facility_exists);

if($facility_exists > 0) {
    echo "already exists";
    exit();
}

$dataman->add_facility(
    $facility['facility_name'], $facility['facility_type'], $facility['facility_contact'], $facility['facility_description'],
    $facility['facility_location'], $facility['location_coordinates'], $facility['facility_state'], $facility['facility_floors']
);

echo "working";