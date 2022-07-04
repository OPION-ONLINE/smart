<?php
require_once "../../dataman.php";

$dataman = new Dataman();
$limit = $_POST['limit'];
$start_id = $_POST['start_id'];
$search_query = $_POST['search_query'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$limit = (int) $limit;
$start_id = (int) $start_id;
$result_array = $dataman->search_facilities($search_query, $start_id, $limit, $start_date, $end_date);

header('Content-Type: application/json');
echo json_encode($result_array);