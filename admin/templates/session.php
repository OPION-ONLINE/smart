<?php session_start();
// echo $_SESSION['user_role'];
 
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] == null){
    header("Location: admin.php");
}