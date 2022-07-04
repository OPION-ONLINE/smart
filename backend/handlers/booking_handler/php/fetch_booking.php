<?php
require_once '../../dataman.php';

$booking_id = $_POST['booking_id'];

$dataman = new Dataman();

$result = $dataman->fetch_booking($booking_id);

header('Content-Type: application/json');
echo json_encode($result);