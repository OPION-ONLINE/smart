<?php require_once "templates/session.php"?>

<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);





 $password = $_POST['password'];
 
 

 

$conn = new mysqli('localhost', 'root', '', 'efacility5');


$ID = mysqli_real_escape_string($conn, $_GET['ID']);

 
 
if ($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
    header("refresh:1; url=Permissions.php");

}
else
{
    
    

    if(isset($_POST['update'])){

      

        // UPDATE ADMIN ROLE
        if($password != null){
            $query = "update passwords set `password` = '$password' where id = $ID";
            $query_run = mysqli_query($conn, $query);

                if($query_run){   
                    echo '<script type="text/javascript"> alert("Password Updated") </script>';
                }
                else{
                    echo '<script type="text/javascript"> alert("Password Not Updated, Something went wrong")</script>';
                }
            }  
    }

    header("refresh:1; url=password.php");



}