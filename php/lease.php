 <?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


    $first_name_m   = $_POST['first_name_m'];
    $last_name_m    = $_POST['last_name_m'];
    $email_m        = $_POST['email_m'];
    $phonenumber_m  = $_POST['phone_m'];

    $first_name_o   = $_POST['first_name_o'];
    $last_name_o    = $_POST['last_name_o'];
    $email_o        = $_POST['email_o'];
    $phonenumber_o  = $_POST['phone_o'];

    $apartment_name = $_POST['apartment_name'];
    $position       = $_POST['position'];
    $zip            = $_POST['zip'];
    $location       = $_POST['location'];
    $quantity       = $_POST['quantity'];

    $fullname = $_POST['first_name_m'] . " " . $_POST['last_name_m'];


    $conn = new mysqli('localhost', 'root', '', 'opion');

 
    if ($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }
    else
    {
        
    
        $stmt = $conn->prepare("insert into lease (`first_name(manager)`, `last_name(manager)`, `email(manager)`, `phone(manager)`, `first_name(owner)`, `last_name(owner)`, `email(owner)`, `phone(owner)`, `apartment_name`, `apartment_category`, `gps_code`, `location`, `available_rooms`, `fullname`)
        values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssssssssss", $first_name_m, $last_name_m, $email_m, $phonenumber_m , $first_name_o, $last_name_o, $email_o, $phonenumber_o, $apartment_name, $position, $zip, $location, $quantity, $fullname);



        $stmt->execute();

         echo '<script type= "text/javascript"> alert("Registeration Successful")</script>';

         $stmt->close();
        $conn->close();

          
        
 
         


    }


 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Instructions</title>
    <link rel="stylesheet" href="../css/manager_instructions.css">
    <link rel="stylesheet" href="../css/general.css">
</head>
<body>

    <div class="container">
        <div class="navigation">
                 <h4 onclick="location.href='../index.html'">BACK TO HOMEPAGE</h4>
                <h4 onclick="location.href='../search.html'">SEARCH A PROPERTY</h4>
             
        </div>

        <div class="content">

        <div class="title"><h3>CONGRATULATIONS</h3></div>

        <p>Thank you Mr/Mrs <?php echo $last_name_m; ?> for registering with <span>Opion H-CUBE</span>. </p>
        <p>You are now the manager of <?php echo $apartment_name;?>. We will contact you via the mobile number you provided within 24 hours to finalize you Registration.  </p>
        <p>In the meantime, if it is urgent that you contact us immediately, you can do so by sending an email to <a>opiononlinegh@gmail.com</a> or by calling +233 500 0000</p>
        <div class="space"></div>



        </div>
    </div>
    
</body>
</html>





