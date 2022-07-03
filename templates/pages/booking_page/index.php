<?php

/*
if( !isset($GET['facility_name']) || !isset($GET['facility_type']) || !isset($GET['facility_location']) || !isset($_SESSION['LOGIN'])) {
    header('location: signup');
}

// $facility_name = $GET['facility_name'];
// $facility_type = $GET['facility_type'];
// $facility_location = $GET['facility_location'];

*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once $environment_link . "templates/components/head.php";
     ?>
    <link rel = 'stylesheet' href = 'styles/pages/booking_page/index.css'>
</head>
<body>
    <div class = 'wrapper'>
        <?php 
            require_once $environment_link . "templates/pages/booking_page/index.html";
        ?>

    </div>
    
</body>
</html>