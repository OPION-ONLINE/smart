<?php require_once "templates/session.php"?>

<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);





 

$conn = new mysqli('localhost', 'root', '', 'efacility5');


 
 
 
if ($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}
else
{

//ADMININSTRATOR LOGIN
    if(isset($_POST['login'])){

        $admin_name = $_POST['admin_name'];
        $admin_password = $_POST['admin_password'];
 

        $query = "SELECT * FROM `permissions` WHERE `admin_name` = '$admin_name'";
        $result = mysqli_query($conn, $query) or die ("Unsuccessful Query");
        $row = mysqli_fetch_array($result);


        $login_role = $row['role'];
 
        $query2 = "SELECT * FROM `passwords` WHERE `role` = '$login_role'";
        $result2 = mysqli_query($conn, $query2) or die ("Unsuccessful Query");
        $row2 = mysqli_fetch_array($result2);

        $role_password = $row2['password'];

        if(!isset($login_role) || !isset($role_password)){


            echo "<script> alert('Something Went Wrong') </script>";
            header("refresh:1; url=admin.php");


        }
        else{



            if ($role_password == $admin_password){
                echo "<script> alert('Login Successful') </script>";
                
                $_SESSION['user_role'] = $login_role;
                //pass session token

 
                echo '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <link rel="stylesheet" href="css/admin_loading.css">
                </head>
                <body>
                
                     <div class="container">
                        <div class="text">
                            <h3>Logging Into Opion As . . . </h3>' ; 
               
                            echo $login_role;
                
                 echo '       </div>
                
                
                
                     </div>
                    
                </body>
                </html>
                
                
                   '; 
 
                 header("refresh:5; url=index.php");

                
            }

            else {
                echo "<script> alert('Something went wrong') </script>";
                header("refresh:1; url=admin.php");


                
            }
                

        }
 




        
    

         

         


    }


    
    
// UPDATE ADMININSTRATORS

    if(isset($_POST['update'])){

        $admin_name = $_POST['admin_name'];
        $role = $_POST['role'];


        if ($admin_name != null && $role != null){
            
    
        $stmt = $conn->prepare("insert into permissions (`admin_name`, `role`) values (?,?)");
        $stmt->bind_param("ss", $admin_name, $role);



        $stmt->execute();

        if($stmt){
            echo '<script type="text/javascript"> alert("New Admininstrator Added") </script>';
         }
        else{
            echo '<script type="text/javascript"> alert("Something Went Wrong, Admininstrator was not added ")</script>';
        }

        $stmt->close();
        $conn->close();

        header("refresh:1; url=Permissions.php");


        }

        else{
            echo '<script type="text/javascript"> alert("Please Add Inputs In All Field") </script>';
            header("refresh:1; url=add_admininstrator.php");


        }

  
       
 

       
            

     
       
    }
 

 
 

}

?>
