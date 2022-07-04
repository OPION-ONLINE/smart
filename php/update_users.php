<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 


$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];
$user_number = $_POST['user_number'];

$user_status = $_POST['user_status'];
$user_gender = $_POST['user_gender'];
/*$email_owner = $_POST['email_owner'];

$property_name = $_POST['property_name'];
$property_type = $_POST['property_type'];
$property_location = $_POST['property_location'];
 


$user_name = $_POST['manager_id'];
$user_name = $_POST['manager_id'];
$user_name = $_POST['manager_id'];
$user_name = $_POST['manager_id'];
$user_name = $_POST['manager_id'];
$user_name = $_POST['manager_id'];

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
        if ($user_name != null){
            $query = "update users set `user_name` = '$user_name' where user_id = $ID";
            $query_run = mysqli_query($conn, $query);

            if($query_run){   
                echo '<script type="text/javascript"> alert("User Name Updated") </script>';
            }
            else{
                echo '<script type="text/javascript"> alert("User Name  Not Updated, Something went wrong")</script>';
            }
            

     
        }
         // UPDATE LAST NAME MANAGER
        if($user_email != null){
            $query = "UPDATE `users` SET `user_email` = '$user_email' WHERE user_id = $ID";
            $query_run = mysqli_query($conn, $query);

                if($query_run){   
                    echo '<script type="text/javascript"> alert("User Email Updated") </script>';
                }
                else{
                    echo '<script type="text/javascript"> alert("User Email  Not Updated, Something went wrong")</script>';
                }
            }
 

        // UPDATE EMAIL MANAGER
        if($user_number != null){
            $query = "UPDATE `users` SET `user_number` = '$user_number' WHERE user_id = $ID";
            $query_run = mysqli_query($conn, $query);

                if($query_run){   
                    echo '<script type="text/javascript"> alert("User Phone Updated Update") </script>';
                }
                else{
                    echo '<script type="text/javascript"> alert("User Phone Not Updated, Something went wrong")</script>';
                }
            }

      

        // UPDATE PHONE MANAGER
        if($user_status != null){
            $query = "UPDATE `users` SET `user_status` = '$user_status' WHERE user_id = $ID";
            $query_run = mysqli_query($conn, $query);

                if($query_run){   
                    echo '<script type="text/javascript"> alert("User Status Updated") </script>';
                }
                else{
                    echo '<script type="text/javascript"> alert("User Status Not Updated, Something went wrong")</script>';
                }
            }



        // UPDATE FIRST NAME OWNER
        if ($user_gender != null){
            $query = "update users set `user_gender` = '$user_gender' where user_id = $ID";
            $query_run = mysqli_query($conn, $query);

            if($query_run){   
                echo '<script type="text/javascript"> alert("User Gender Updated") </script>';
            }
            else{
                echo '<script type="text/javascript"> alert("User Gender Not Updated, Something went wrong")</script>';
            }
            

     
        }

        header("refresh:1; url=../admin/users.php?ID=$ID");

        // UPDATE LAST NAME OWNER
    }

}