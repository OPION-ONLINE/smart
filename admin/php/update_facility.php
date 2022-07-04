<?php

require_once '../../conn/conn.php';

$facility_name          = $_POST['facility_name'];
$facility_type          = $_POST['facility_type'];
$facility_location      = $_POST['facility_location'];
$old_facility_name          = $_POST['old_facility_name'];
$old_facility_location      = $_POST['old_facility_location'];
$facility_contact          = $_POST['facility_contact'];
$facility_description          = $_POST['facility_description'];
$facility_state          = $_POST['facility_state'];
$cover_image          = $_POST['cover_image'];
$rating          = $_POST['rating'];


$sql = 'select * from facilities where facility_name = ? and facility_type = ? and facility_location = ?';
// echo "select * from blocks where facility_block = '$facility_block' and facility_name = '$facility_name' and facility_type = '$facility_type' and facility_location = '$facility_location'";
$sql = $conn->prepare($sql);
$sql->bind_param('sss',   $facility_name, $facility_type, $facility_location);
$sql->execute();
$result = $sql->get_result();

if($result->num_rows > 0 && $facility_name != $old_facility_name) {
    echo 'exists';
    exit();
}

$sql = 'select * from facilities where facility_name = ? and facility_type = ? and facility_location = ?';
// echo "select * from facilities where facility_name = '$old_facility_name' and facility_type = '$facility_type and facility_location = '$old_facility_location';";
$sql = $conn->prepare($sql);
$sql->bind_param('sss',   $old_facility_name, $facility_type, $old_facility_location);
$sql->execute();
$result = $sql->get_result();

if($result->num_rows > 0) {

$sql = 'update  plans set facility_name = ?,  facility_location = ? where facility_name = ? and facility_type = ? and facility_location = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sssss', $facility_name, $facility_location, $old_facility_name, $facility_type, $old_facility_location);
$sql->execute();

$sql = 'update  rooms set facility_name = ?,  facility_location = ? where facility_name = ? and facility_type = ? and facility_location = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sssss', $facility_name, $facility_location, $old_facility_name, $facility_type, $old_facility_location);
$sql->execute();

$sql = 'update  floors set facility_name = ?,  facility_location = ? where facility_name = ? and facility_type = ? and facility_location = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sssss', $facility_name, $facility_location, $old_facility_name, $facility_type, $old_facility_location);
$sql->execute();

$sql = 'update  blocks set facility_name = ?,  facility_location = ? where facility_name = ? and facility_type = ? and facility_location = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('sssss', $facility_name, $facility_location, $old_facility_name, $facility_type, $old_facility_location);
$sql->execute();

$sql = 'update  facilities set facility_name = ?,  facility_location = ?, facility_contact = ?, facility_description = ?, facility_state = ?, cover_image = ?, rating = ? where    facility_name = ? and facility_type = ? and facility_location = ?';
// echo "update  facilities set facility_name = '$facility_name',  facility_location = '$facility_location', facility_contact = '$facility_contact', facility_description = '$facility_description', facility_state = '$facility_state', cover_image = '$cover_image', rating = '$rating' where facility_name = '$old_facility_name' and facility_type = '$facility_type' and facility_location = '$old_facility_location';";
$sql = $conn->prepare($sql);
$sql->bind_param('ssssssssss', $facility_name, $facility_location, $facility_contact, $facility_description, $facility_state, $cover_image, $rating, $old_facility_name, $facility_type, $old_facility_location);


if($sql->execute()) {
    echo 'success';
}

else echo "error facili";

} else echo "error not exist";