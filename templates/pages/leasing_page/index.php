<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once $environment_link . "templates/components/head.php";
        // require_once $environment_link . "conn/home_page/index.php";
    ?>
    <link rel = 'stylesheet' href = '<?php echo 'styles/pages/signup_page/index.css';?>'>
    <link rel = 'stylesheet' href = '<?php echo 'styles/pages/leasing_page/index.css';?>'>

    <!-- <link rel = 'stylesheet' href = '<?php echo 'styles/components/homecard.css';?>'> -->
    <!-- <link rel = 'stylesheet' href = '<?php echo 'styles/components/footer.css';?>'> -->
</head>
<body>
    <div class = 'wrapper'>
        <?php 
            
            require_once $environment_link . "templates/pages/leasing_page/index.html";
        ?>

    </div>

    <!-- <script src = '<?php echo 'scripts/js/leasing_page/search.js';?>'></script> -->
</body>
</html>