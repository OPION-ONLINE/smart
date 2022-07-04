<?php
require_once $environment_link . "conn/conn.php";

if(!isset($_GET['ver']) || empty($_GET['ver']) ) header('location: login');

$ver = $_GET['ver'];

$sql = 'select * from verification where link = ?';
$sql = $conn->prepare($sql);
$sql->bind_param('s', $ver);
$sql->execute();

$result = $sql->get_result();

if($result->num_rows <= 0) header('location: login');