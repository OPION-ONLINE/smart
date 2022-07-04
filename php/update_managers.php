<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);





$full_name_manager = $_POST['full_name_manager'];
$phone_manager = $_POST['phone_manager'];
$email_manager = $_POST['email_manager'];

$full_name_owner = $_POST['full_name_owner'];
$phone_owner = $_POST['phone_owner'];
$email_owner = $_POST['email_owner'];

$property_name = $_POST['property_name'];
$property_type = $_POST['property_type'];
$property_location = $_POST['property_location'];
 


/*$full_name_manager = $_POST['manager_id'];
$full_name_manager = $_POST['manager_id'];
$full_name_manager = $_POST['manager_id'];
$full_name_manager = $_POST['manager_id'];
$full_name_manager = $_POST['manager_id'];
$full_name_manager = $_POST['manager_id'];

*/

$conn = new mysqli('localhost', 'root', '', 'efacility5');


$ID = mysqli_real_escape_string($conn, $_GET['ID']);

 
 
if ($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}
else
{
    
    

    if(isset($_POST['update'])){

        // UPDATE FIRST NAME MANAGER
        if ($full_name_manager != null){
            $query = "update managers set `full_name_manager` = '$full_name_manager' where id = $ID";
            $query_run = mysqli_query($conn, $query);

            if($query_run){   
                echo '<script type="text/javascript"> alert("Manager\'s Name Updated") </script>';
            }
            else{
                echo '<script type="text/javascript"> alert("Manager\'s Name  Not Updated, Something went wrong")</script>';
            }
            

     
        }

        // UPDATE LAST NAME MANAGER
        if($phone_manager != null){
            $query = "UPDATE `managers` SET `phone_manager` = '$phone_manager' WHERE id = $ID";
            $query_run = mysqli_query($conn, $query);

                if($query_run){   
                    echo '<script type="text/javascript"> alert("Manager\'s Phone Updated") </script>';
                }
                else{
                    echo '<script type="text/javascript"> alert("Manager\'s Phone  Not Updated, Something went wrong")</script>';
                }
            }
 

        // UPDATE EMAIL MANAGER
        if($email_manager != null){
            $query = "UPDATE `managers` SET `email_manager` = '$email_manager' WHERE id = $ID";
            $query_run = mysqli_query($conn, $query);

                if($query_run){   
                    echo '<script type="text/javascript"> alert("Manager\'s Email Updated Update") </script>';
                }
                else{
                    echo '<script type="text/javascript"> alert("Manager\'s Email Not Updated, Something went wrong")</script>';
                }
            }

      

        // UPDATE PHONE MANAGER
        if($full_name_owner != null){
            $query = "UPDATE `managers` SET `full_name_manager` = '$full_name_owner' WHERE id = $ID";
            $query_run = mysqli_query($conn, $query);

                if($query_run){   
                    echo '<script type="text/javascript"> alert("Owner\'s Name Updated") </script>';
                }
                else{
                    echo '<script type="text/javascript"> alert("Owner\'s Name Not Updated, Something went wrong")</script>';
                }
            }



        // UPDATE FIRST NAME OWNER
        if ($phone_owner != null){
            $query = "update managers set `phone_owner` = '$phone_owner' where id = $ID";
            $query_run = mysqli_query($conn, $query);

            if($query_run){   
                echo '<script type="text/javascript"> alert("Owner\'s Phone Updated") </script>';
            }
            else{
                echo '<script type="text/javascript"> alert("Owner\'s Phone  Not Updated, Something went wrong")</script>';
            }
            

     
        }
        // UPDATE LAST NAME OWNER
        if($email_owner != null){
            $query = "UPDATE `managers` SET `email_owner` = '$email_owner' WHERE id = $ID";
            $query_run = mysqli_query($conn, $query);

                if($query_run){   
                    echo '<script type="text/javascript"> alert("Owner\'s Email Updated") </script>';
                }
                else{
                    echo '<script type="text/javascript"> alert("Owner\'s Email  Not Updated, Something went wrong")</script>';
                }
            }
 

        // UPDATE EMAIL OWNER
        if($property_name != null){
            $query = "UPDATE `managers` SET `property_name` = '$property_name' WHERE id = $ID";
            $query_run = mysqli_query($conn, $query);

                if($query_run){   
                    echo '<script type="text/javascript"> alert("Property Name Updated") </script>';
                }
                else{
                    echo '<script type="text/javascript"> alert("Property Name Not Updated, Something went wrong")</script>';
                }
            }

      

        // UPDATE PHONE OWNER
        if($property_type != null){
            $query = "UPDATE `managers` SET `property_type` = '$property_type' WHERE id = $ID";
            $query_run = mysqli_query($conn, $query);

                if($query_run){   
                    echo '<script type="text/javascript"> alert("Property Type Updated") </script>';
                }
                else{
                    echo '<script type="text/javascript"> alert("Property Type Not Updated, Something went wrong")</script>';
                }
            }
 


             // UPDATE APARTMENT NAME
        if($property_location != null){
            $query = "UPDATE `managers` SET `property_location` = '$property_location' WHERE id = $ID";
            $query_run = mysqli_query($conn, $query);

                if($query_run){   
                    echo '<script type="text/javascript"> alert("Property Location Updated") </script>';
                }
                else{
                    echo '<script type="text/javascript"> alert("Property Location Not Updated, Something went wrong")</script>';
                }
            }
            header("refresh:1; url=../admin/managerDetails.php?ID=$ID");


             
  
        



 
        
    }


}