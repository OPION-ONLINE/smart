<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once $environment_link . "templates/components/head.php";
        require_once $environment_link . "conn/home_page/index.php";
    ?>
    <link rel = 'stylesheet' href = '<?php echo $environment_link . 'styles/pages/home_page/homepage.css';?>'>
    <link rel = 'stylesheet' href = '<?php echo $environment_link . 'styles/components/homecard.css';?>'>
    <link rel = 'stylesheet' href = '<?php echo $environment_link . 'styles/components/footer.css';?>'>
</head>
<body>
    <div class = 'wrapper'>
        <?php 
            require_once $environment_link . "templates/components/navigation.php";
            require_once $environment_link . "templates/components/homecard.php"; 
            require_once $environment_link . "templates/pages/home_page/index.html";
        ?>

        <section class = 'p-rel p-3 flex-wrap flex-center'>
            <?php
                foreach($result_array as $facility => $values) {
                    homecard($values['facility_name'], $values['facility_location'], $values['facility_type'], 2000, 'images/' . $values['cover_image']);
                }
            ?>
        </section>

        <?php 
            require_once $environment_link . "templates/components/footer.php";
        ?>

    </div>

    <script src = '<?php echo $environment_link . 'scripts/js/homepage/search.js';?>'></script>
</body>
</html>