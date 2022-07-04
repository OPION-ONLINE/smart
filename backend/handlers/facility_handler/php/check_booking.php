<?php

require_once "../../dataman.php";

$dataman   = new Dataman();
$username  = $_POST['username'];
$useremail = $_POST['useremail'];

$booking = $dataman->check_booking($username, $useremail);

$current_date = new DateTime();
$booking_date = new DateTime($booking[0]['booking_date']);
$howLong = $current_date->diff($booking_date)->format('%d');
$howLong = (int) $howLong;

if(sizeof($booking) > 0 && $howLong < 1) {
    echo 'true';
}
else echo 'false';