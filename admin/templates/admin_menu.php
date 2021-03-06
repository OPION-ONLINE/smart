<?php  


/* SUPER administratorS CAN ACCESS 
        ~all admin tabs

    SITE administratorS CAN ACCESS
        ~all admin tabs except the [PERMISSIONS TAB]

    FACILITY administratorS CAN ACCESS
        ~only the [FACILITY TAB]

    USER administratorS CAN ACCESS
        ~the USERS TAB
        ~the MANAGERS TAB
        ~the EMAIL TAB


    The user roles are
        super_administrator
        site_administrator
        facility_administrator
        user_administrator

    
*/


if (!isset($_SESSION['user_role'])){
    header("Location: admin.php");
}

// else echo $_SESSION['user_role'];
 
function facility_check(){
    if (isset($_SESSION['user_role'])                 &&
    ($_SESSION['user_role'] == 'super_administrator' || 
    $_SESSION['user_role'] == 'site_administrator'   || 
    $_SESSION['user_role'] == 'facility_administrator') 
    ){
        return true;
    }
    {
        return false;
    }
}

function home_check(){
    if (isset($_SESSION['user_role'])                 &&
    ($_SESSION['user_role'] == 'super_administrator'  ||
    $_SESSION['user_role'] == 'site_administrator')
    ){
        return true;
    }
    {
        return false;
    }
}


function booking_check(){
    if (isset($_SESSION['user_role'])                 &&
    ($_SESSION['user_role'] == 'super_administrator'  ||
    $_SESSION['user_role'] == 'site_administrator')   ||
    $_SESSION['user_role'] == 'booking_administrator'
    ){
        return true;
    }
    {
        return false;
    }
}




function users_check(){
    if (isset($_SESSION['user_role'])                 &&
    ($_SESSION['user_role'] == 'super_administrator'  ||
    $_SESSION['user_role'] == 'site_administrator')   ||
    $_SESSION['user_role'] == 'user_administrator'
    ){
        return true;
    }
    {
        return false;
    }
}



function permissions_check(){
    if (isset($_SESSION['user_role'])                 &&
     $_SESSION['user_role'] == 'super_administrator'
     ){
        return true;
    }
    {
        return false;
    }
}





?>
<div class = 'menu'>


<?php 
if (home_check()){
    echo "
    <div class = 'menu-item flex-row ' onclick = 'location.href = \"index.php\";'>
        <div class = 'icon'><i class = 'bi bi-house-door'></i></div>
        <div class = 'item'>Home</div>
    </div>
    
    ";
}
?>


<?php 
if (booking_check()){
    echo "


    <div class = 'menu-item flex-row ' onclick = 'location.href = \"booking.php\";'>
        <div class = 'icon'><i class = 'bi bi-cash'></i></div>
        <div class = 'item'>Bookings</div>
    </div>
   
    
    ";
}
?>


<?php 

    if(facility_check()){
        echo "
        <div class = 'menu-item flex-row ' onclick = 'location.href = \"facilities.php\";'>
            <div class = 'icon'><i class = 'bi bi-reception-3'></i></div>
            <div class = 'item'>Facilities</div>
         </div>
    ";
    }

?>



<?php 

    if(users_check()){
        echo "
            
            <div class = 'menu-item flex-row ' onclick = 'location.href = \"usersList.php\";'>
                <div class = 'icon'><i class = 'bi bi-people'></i></div>
                <div class = 'item'>Users</div>
            </div>


            <div class = 'menu-item flex-row ' onclick = 'location.href = \"email.php\";'>
                <div class = 'icon'><i class = 'bi bi-envelope'></i></div>
                <div class = 'item'>Emails</div>
            </div>

            <div class = 'menu-item flex-row ' onclick = 'location.href = \"managers.php\";'>
                <div class = 'icon'><i class='bi bi-clipboard2-check'></i></div>
                <div class = 'item'>Managers</div>
            </div>
    ";
    }

?>


<?php 

    if(permissions_check()){
        echo "
            
                
        <div class = 'menu-item flex-row ' onclick = 'location.href = \"Permissions.php\";'>
            <div class = 'icon'><i class = 'bi bi-shield-check'></i></div>
            <div class = 'item'>Permissions</div>
        </div>

    ";
    }

?>










<div class = 'menu-item flex-row ' onclick = 'location.href = "templates/session_destroy.php";'>
    <div class = 'icon'><i class = 'bi bi-box-arrow-left'></i></div>
    <div class = 'item'>Exit</div>
</div>

</div>

