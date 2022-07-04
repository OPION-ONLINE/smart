<?php
require_once '../../dataman.php';

$start_id = $_POST['start_id'];
$limit = $_POST['limit'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$dataman = new Dataman();

$result = $dataman->fetch_bookings($start_id, $limit, $start_date, $end_date);

header('Content-Type: application/json');
echo json_encode($result);