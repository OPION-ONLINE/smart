<?php
require_once '../../dataman.php';

$start_id = $_POST['start_id'];
$limit = $_POST['limit'];
$dataman = new Dataman();
$result = $dataman->fetch_images($start_id, $limit);

header('Content-type: application/json');
echo json_encode($result);