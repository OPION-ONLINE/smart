<?php
session_start();

if( !isset($_GET['facility_name']) || !isset($_GET['facility_type']) || !isset($_GET['facility_location']) || !isset($_SESSION['LOGIN'])) {
    // header('location: signup');
}

$facility_name = $_GET['facility_name'];
$facility_type = $_GET['facility_type'];
$facility_location = $_GET['facility_location'];

require_once $environment_link . "conn/booking_page/booking.php";

foreach($result_array as $result => $facility) {
    $facility_description = $facility['facility_description'];
    $facility_image = $facility['cover_image'];
}

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

    
    
    <script>
        let facility_name     = "<?php echo $facility_name; ?>";
        let facility_type     = "<?php echo $facility_type; ?>";
        let facility_location = "<?php echo $facility_location; ?>";
    </script>
    
    <script src = 'scripts/js/booking/book.js'></script>
</body>
</html>