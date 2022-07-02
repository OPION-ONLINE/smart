<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'efacility5';

$conn = new mysqli($host, $username, $password, $database);

if($conn->connect_error) {
    die('DB ERR: '. $conn->connect_error);
}