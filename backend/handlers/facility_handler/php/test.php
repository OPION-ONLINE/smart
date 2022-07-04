<?php

require_once '../../dataman.php';

$dataman = new Dataman();

$floors = $dataman->fetch_floors("Shalom's International Hostel", "Hostel");

var_dump($floors);