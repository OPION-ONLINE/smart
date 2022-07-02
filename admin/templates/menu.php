<?php
session_start();

function home_check() {
    if(
        isset($_SESSION['user_role'])         &&
        (
        $_SESSION['user_role'] == 'super_user' ||
        $_SESSION['user_role'] == 'site_admin'
        )
    )
    
    {
        
        return true;
    }
    
    return false;
}

function booking_check() {
    if(
        isset($_SESSION['user_role'])         &&
        (
        $_SESSION['user_role'] == 'super_user' ||
        $_SESSION['user_role'] == 'booking_admin'
        )
    )
    {
        return true;
    }
    
    return false;
}

function facility_check() {}
function user_check() {}
function permission_check() {}

?>


<div class = 'left full-vh full-w p-rel'>
    <div class = 'close-btn flex-center p-abs top-right' onclick = 'deactivate("main > .left");'>
        <i class = 'bi bi-x-lg p-1'></i>
    </div>
    <div class = 'menu'>
        

        <?php 
            if( home_check() ) {
                
                echo "
                    <div class = 'menu-item flex-row  active' onclick = 'location.href = \"index.html\";'>
                        <div class = 'icon'><i class = 'bi bi-house-door'></i></div>
                        <div class = 'item'>Home</div>
                    </div>
                ";
            }

            if( booking_check() ) {
                echo "
                    <div class = 'menu-item flex-row ' onclick = 'location.href = \"booking.html\";'>
                        <div class = 'icon'><i class = 'bi bi-cash'></i></div>
                        <div class = 'item'>Bookings</div>
                    </div>
                ";
            }

            if( facility_check() ) {
                echo `
                    <div class = 'menu-item flex-row ' onclick = 'location.href = "facilities.html";'>
                        <div class = 'icon'><i class = 'bi bi-reception-3'></i></div>
                        <div class = 'item'>Facilities</div>
                    </div>
                `;
            }

            if( user_check() ) {
                echo `
                    <div class = 'menu-item flex-row ' onclick = 'location.href = "usersList.html";'>
                        <div class = 'icon'><i class = 'bi bi-people'></i></div>
                        <div class = 'item'>Users</div>
                    </div>
                `;
            }

            if( permission_check() ) {
                echo `
                    <div class = 'menu-item flex-row ' onclick = 'location.href = "Permissions.html";'>
                        <div class = 'icon'><i class = 'bi bi-shield-check'></i></div>
                        <div class = 'item'>Permissions</div>
                    </div>
                `;
            }
        ?>

        <div class = 'menu-item flex-row ' onclick = 'location.href = "booking.html";'>
            <div class = 'icon'><i class = 'bi bi-box-arrow-left'></i></div>
            <div class = 'item'>Exit</div>
        </div>

    </div>
</div>