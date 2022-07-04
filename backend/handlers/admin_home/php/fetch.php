<?php

require_once '../../dataman.php';

$dataman = new Dataman();
$result_array = $dataman->admin_home();

header('Content-Type: application/json');
echo json_encode($result_array);