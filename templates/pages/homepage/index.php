<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once $environment_link . "templates/sections/head.php";?>
    <link rel = 'stylesheet' href = '<?php echo $environment_link . 'styles/pages/homepage.css';?>'>
</head>
<body>
    <div class = 'wrapper'>
        <?php 
        require_once $environment_link . "templates/sections/navigation.php"; 
        require_once $environment_link . "templates/pages/homepage/index.html";
        ?>
    </div>
    
</body>
</html>