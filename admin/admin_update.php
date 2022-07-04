<?php require_once "templates/session.php"?>

<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);





$admin_name = $_POST['admin_name'];
$role = $_POST['role'];
 
 

 

$conn = new mysqli('localhost', 'root', '', 'efacility5');


$ID = mysqli_real_escape_string($conn, $_GET['ID']);

 
 
if ($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
    header("refresh:1; url=Permissions.php");

}
else
{
    
    

    if(isset($_POST['update'])){

        // UPDATE ADMIN NAME
        if ($admin_name != null){
            $query = "update permissions set `admin_name` = '$admin_name' where id = $ID";
            $query_run = mysqli_query($conn, $query);

          

            if($query_run){   
                echo '<script type="text/javascript"> alert("Admininstrator Name Updated") </script>';
            }
            else{
                echo '<script type="text/javascript"> alert("Admininstrator Name Not Updated, Something went wrong")</script>';
            }
            

     
        }

        // UPDATE ADMIN ROLE
        if($role != null){
            $query = "update permissions set `role` = '$role' where id = $ID";
            $query_run = mysqli_query($conn, $query);

                if($query_run){   
                    echo '<script type="text/javascript"> alert("Role Updated") </script>';
                }
                else{
                    echo '<script type="text/javascript"> alert("Role Not Updated, Something went wrong")</script>';
                }
            }  
    }

    header("refresh:1; url=Permissions.php");



}