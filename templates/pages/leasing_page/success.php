
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Instructions</title>
    <link rel = 'stylesheet' href = '<?php echo '../../../styles/pages/leasing_page/index.css';?>'>

    <?php
        // require_once $environment_link . "conn/leasing_page/leasing_page.php";
        $name_manager = $_GET['name_manager'];
        $property_name = $_GET['property_name'];
    ?>
 </head>
<body>

    <div class="container">
        <div class="navigation">
                 <h4 onclick="location.href='../index.html'">BACK TO HOMEPAGE</h4>
                <h4 onclick="location.href='../search.html'">SEARCH A PROPERTY</h4>
             
        </div>

        <div class="content">

        <div class="title"><h3>CONGRATULATIONS</h3></div>

        <p>Thank you Mr/Mrs <?php echo $name_manager . $environment_link; ?> for registering with <span>Opion H-CUBE</span>. </p>
        <p>You are now the manager of <?php echo $property_name;?>. We will contact you via the mobile number you provided within 48 hours to finalize you Registration.  </p>
        <p>In the meantime, if it is urgent that you contact us immediately, you can do so by sending an email to <a>opiononlinegh@gmail.com</a> or by calling +233 500 0000</p>
        <div class="space"></div>



        </div>
    </div>
    
</body>
</html>



