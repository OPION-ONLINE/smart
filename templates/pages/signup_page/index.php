<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once $environment_link . "templates/components/head.php";
        require_once $environment_link . "conn/home_page/index.php";
    ?>
    <link rel = 'stylesheet' href = 'styles/pages/signup_page/index.css';?>'>
    <!-- <link rel = 'stylesheet' href = 'styles/components/homecard.css';?>'> -->
    <!-- <link rel = 'stylesheet' href = 'styles/components/footer.css';?>'> -->
</head>
<body>
    <div class = 'wrapper'>
        <?php 
            
            require_once $environment_link . "templates/pages/signup_page/index.html";
        ?>

    </div>

    <!-- <script src = '<?php echo $environment_link . 'scripts/js/signup_page/search.js';?>'></script> -->
</body>

</html>