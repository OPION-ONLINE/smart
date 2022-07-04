<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once $environment_link . "templates/components/head.php";
        require_once $environment_link . "conn/newpassword/verify.php";
    ?>
    <link rel = 'stylesheet' href = 'styles/pages/signup_page/index.css'>
    <!-- <link rel = 'stylesheet' href = 'styles/components/homecard.css';?>'> -->
    <!-- <link rel = 'stylesheet' href = 'styles/components/footer.css';?>'> -->
</head>
<body>
    <div class = 'wrapper'>
        <?php 
            
            require_once $environment_link . "templates/pages/newpassword/index.html";
        ?>

    </div>

    <script src = 'scripts/js/authentication/create.js'></script>
</body>

</html>