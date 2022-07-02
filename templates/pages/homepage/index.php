<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once $environment_link . "templates/components/head.php";?>
    <link rel = 'stylesheet' href = '<?php echo $environment_link . 'styles/pages/homepage/homepage.css';?>'>
    <link rel = 'stylesheet' href = '<?php echo $environment_link . 'styles/components/homecard.css';?>'>
    <link rel = 'stylesheet' href = '<?php echo $environment_link . 'styles/components/footer.css';?>'>
</head>
<body>
    <div class = 'wrapper'>
        <?php 
            require_once $environment_link . "templates/components/navigation.php";
            require_once $environment_link . "templates/components/homecard.php"; 
            require_once $environment_link . "templates/pages/homepage/index.html";
        ?>

        <section class = 'p-rel p-3 flex-wrap flex-center'>
            <?php
                for($i = 0; $i < 8; $i++) {
                    homecard('Evandy Hostel', 'Ayeduase Newsite', 2000, 'images/opion_header_image.jpg');
                }
            ?>
        </section>

        <?php 
            require_once $environment_link . "templates/components/footer.php";

        ?>

    </div>
    
</body>
</html>