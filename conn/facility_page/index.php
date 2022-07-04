<?php

require_once $environment_link . "conn/conn.php";

//my query goes here

$sql = 'select * from facilities order by clicks desc limit 8';
$sql = $conn->prepare($sql);
$sql->execute();
$result = $sql->get_result();
$result_array = array();

while ($row = $result->fetch_assoc()) {
    array_push($result_array, $row);
}