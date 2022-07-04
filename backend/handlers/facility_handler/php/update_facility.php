<?php

require_once "../../dataman.php";

$dataman = new Dataman();
$facility_name = $_POST['facility_name'];
$facility_type = $_POST['facility_type'];
$facility = $_POST['facility'];
$facility = json_decode($facility, true);

var_dump($facility['facility_floors']);

$facility_exists = $dataman->fetch_facility($facility_name, $facility_type);
$facility_exists = sizeof($facility_exists);

if($facility_exists > 0) {
    echo "Updating...";
    $dataman->update_facility(
        $facility_name, $facility_type,
        $facility['facility_name'], $facility['facility_type'], $facility['facility_contact'], $facility['facility_description'],
        $facility['facility_location'], $facility['location_coordinates'], $facility['facility_state'], $facility['facility_floors']
    );
   
}


