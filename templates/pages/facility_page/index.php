<!DOCTYPE html>
<html lang="en">
<head>
<<<<<<< HEAD
    <?php require_once $environment_link . "templates/components/head.php";
    require_once $environment_link . "conn/facility_page/index.php";
    ?>

    <link rel = 'stylesheet' href = '<?php echo $environment_link . 'styles/pages/homepage/homepage.css';?>'>
    <link rel = 'stylesheet' href = '<?php echo $environment_link . 'styles/pages/facility_page/index.css';?>'>
    <link rel = 'stylesheet' href = '<?php echo $environment_link . 'styles/components/footer.css';?>'>

=======
    <?php require_once $environment_link . "templates/components/head.php";?>
    <link rel = 'stylesheet' href = 'styles/pages/homepage/homepage.css'>
    <link rel = 'stylesheet' href = 'styles/pages/facility_page/index.css'>
>>>>>>> 6d11d31d68f8ce0ee907f32b74d2c900f9e06bf0

</head>
<body>
    <div class = 'wrapper'>
        <?php 
        require_once $environment_link . "templates/components/navigation.php"; 
        require_once $environment_link . "templates/components/facilitycard.php";
        require_once $environment_link . "templates/pages/facility_page/index.html";
        require_once $environment_link . "templates/components/footer.php";


        ?>
    </div>
    
</body>
</html>