<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../../templates/configuration.php";
require_once "../conn.php";

    $name_manager   = $_POST['name_manager'];
    $phone_manager  = $_POST['phone_manager'];
    $email_manager  = $_POST['email_manager'];
 
    $name_owner     = $_POST['name_owner'];
    $phone_owner    = $_POST['phone_owner'];
    $email_owner    = $_POST['email_owner'];
 
    $property_name  = $_POST['property_name'];
    $type           = $_POST['type'];
    $location       = $_POST['location'];
 
    
    $stmt = $conn->prepare("insert into managers(`full_name_manager`, `phone_manager`, `email_manager`, `full_name_owner`,  `phone_owner`, `email_owner`, `property_name`, `property_type`, `property_location`)
    values (?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssss", $name_manager, $phone_manager, $email_manager, $name_owner, $phone_owner, $email_owner, $property_name, $type, $location);



    $stmt->execute();
    if ($stmt){

        echo '<script type= "text/javascript"> alert("Registeration Successful")</script>';
        header("refresh:1; url=../../templates/pages/leasing_page/success.php?name_manager=$name_manager&property_name=$property_name");
    }
    else{
        echo '<script type= "text/javascript"> alert("Something Went Wrong, Please try again")</script>';
        header("location: ../../");
    }
    $stmt->close();
    $conn->close();
    
 
?>
