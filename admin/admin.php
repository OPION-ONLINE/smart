<?php

$result_array = ['user_role' => 'super_admininstrator'];

session_start();

$_SESSION['user_role'] = htmlspecialchars($result_array['user_role']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opion Admin Panel</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

     <div class="container">
        <div class="topBar">
            <h4>Powered by Opion</h4>
        </div>

        <div class="content">
            <div class="form">
                <form action="admininstrator_handler.php" method="post">
                    <div class="element first">
                        <label>Admininstrator</label>
                        <input type="text" name="admin_name" name="admin_name">
                    </div>

                    <div class="element">
                        <label>Password</label>
                        <input type="password" name="admin_password">
                    </div>
                    <div class="mid">
                        <input type="submit" name="login" value="Log In">


                    </div>
                </form>
            </div>

            <div class="options" onclick="location.href='../index.html'">
                <h6> back to homepage</h6>
            </div>
        </div>
        
     </div>
    
</body>
</html>