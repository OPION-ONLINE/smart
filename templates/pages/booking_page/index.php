<?php

<<<<<<< HEAD
/*
if( !isset($GET['facility_name']) || !isset($GET['facility_type']) || !isset($GET['facility_location']) || !isset($_SESSION['LOGIN'])) {
    header('location: signup');
}
=======
// if( !isset($GET['facility_name']) || !isset($GET['facility_type']) || !isset($GET['facility_location']) || !isset($_SESSION['LOGIN'])) {
//     header('location: signup');
// }
>>>>>>> 800a836b74ddb0d7537875ccdcd0c86f74f7e1a2

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
    <link rel = 'stylesheet' href = '<?php echo $environment_link . 'styles/pages/booking_page/index.css';?>'>
    <!-- <link rel = 'stylesheet' href = '<?php echo $environment_link . 'styles/components/homecard.css';?>'> -->
    <!-- <link rel = 'stylesheet' href = '<?php echo $environment_link . 'styles/components/footer.css';?>'> -->
</head>
<body>
    <div class = 'wrapper'>
        <?php 
            // require_once $environment_link . "templates/components/navigation.php";
            // require_once $environment_link . "templates/components/homecard.php"; 
            require_once $environment_link . "templates/pages/booking_page/index.html";
        ?>

    </div>
    
</body>
</html>