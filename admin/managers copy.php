<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>

    <link rel = 'stylesheet' href = 'css/general.css'>
    <link rel = 'stylesheet' href = 'css/users.css'>
</head>
<body>
     
<div class = 'wrapper'>

        <main class='full-vhw bg'>
            <!-- Menu Element -->
            <div class = 'left full-vh full-w p-rel'>
                <div class = 'close-btn flex-center p-abs top-right' onclick = 'deactivate("main > .left");'>
                    <i class = 'bi bi-x-lg p-1'></i>
                </div>
                <?php require_once "templates/admin_menu.php"?>

            </div>
            <!-- End of Menu Element -->

            <!-- Admin Screen Element -->
            <div class = 'right full-vh full-w' >

                <div class = 'nav-bar full-w flex-row flex-between'>

                    <div class = 'left flex-row'>
                        <div class = 'menu-btn flex-row' onclick = 'activate("main > .left"); deactivate(".calender");'>
                            <i class = 'bi bi-grid-fill'></i>
                        </div>
                        <div class = 'panel-name'>Registered Managers</div>
                    </div>
                    <div class = 'right'>
                        <div class = 'date-btn flex-row' onclick = 'activate(".calender"); deactivate("main > .left");'>
                            <i class = 'bi bi-calendar3'></i>
                            <span>Calender</span>
                        </div>
                    </div>

                </div>

            <!-- User Elemnt Begins-->
                <div class="search">
                    <input type="text" placeholder="Search Users">
                </div>

                 <div class="listTitle">
                    <div class="lTitle">
                        <h4>Manager</h4>
                    </div>
    
                    <div class="lTitle">
                        <h4>Facility</h4>
                    </div>
    
                    <div class="lTitle">
                        <h4>Date Registered</h4>
                    </div>
                </div>
                   <div class="users uList" >
                    <div class="uDetails" onclick='location.href="managerDetails.php"'>
                        <div class="uName">
                            <h6>N/A</h6>
    
                        </div>
                        <div class="uBooked">
                            <h6>N/A</h6>
    
    
                        </div>
                        <div class="uDate">
                            <h6>N/A</h6>
    
    
                        </div>
    
                    </div>
                    <div class="uDetails" onclick="location.href='managerDetails.php'">
                        <div class="uName">
                            <h6>N/A</h6>
    
                        </div>
                        <div class="uBooked">
                            <h6>N/A</h6>
    
    
                        </div>
                        <div class="uDate">
                            <h6>N/A</h6>
    
    
                        </div>
    
                    </div>
                    <div class="uDetails" onclick="location.href='managerDetails.php'">
                        <div class="uName">
                            <h6>N/A</h6>
    
                        </div>
                        <div class="uBooked">
                            <h6>N/A</h6>
    
    
                        </div>
                        <div class="uDate">
                            <h6>N/A</h6>
    
    
                        </div>
    
                    </div>
                    <div class="uDetails" onclick="location.href='managerDetails.php'">
                        <div class="uName">
                            <h6>N/A</h6>
    
                        </div>
                        <div class="uBooked">
                            <h6>N/A</h6>
    
    
                        </div>
                        <div class="uDate">
                            <h6>N/A</h6>
    
    
                        </div>
    
                    </div>
                    <div class="uDetails" onclick="location.href='managerDetails.php'">
                        <div class="uName">
                            <h6>N/A</h6>
    
                        </div>
                        <div class="uBooked">
                            <h6>N/A</h6>
    
    
                        </div>
                        <div class="uDate">
                            <h6>N/A</h6>
    
    
                        </div>
    
                    </div>
                    <div class="uDetails" onclick="location.href='managerDetails.php'">
                        <div class="uName">
                            <h6>N/A</h6>
    
                        </div>
                        <div class="uBooked">
                            <h6>N/A</h6>
    
    
                        </div>
                        <div class="uDate">
                            <h6>N/A</h6>
    
    
                        </div>
    
                    </div>
                    <div class="uDetails" onclick="location.href='managerDetails.php'">
                        <div class="uName">
                            <h6>N/A</h6>
    
                        </div>
                        <div class="uBooked">
                            <h6>N/A</h6>
    
    
                        </div>
                        <div class="uDate">
                            <h6>N/A</h6>
    
    
                        </div>
    
                    </div>
                    <div class="uDetails" onclick="location.href='managerDetails.php'">
                        <div class="uName">
                            <h6>N/A</h6>
    
                        </div>
                        <div class="uBooked">
                            <h6>N/A</h6>
    
    
                        </div>
                        <div class="uDate">
                            <h6>N/A</h6>
    
    
                        </div>
    
                    </div>
                    <div class="uDetails" onclick="location.href='managerDetails.php'">
                        <div class="uName">
                            <h6>N/A</h6>
    
                        </div>
                        <div class="uBooked">
                            <h6>N/A</h6>
    
    
                        </div>
                        <div class="uDate">
                            <h6>N/A</h6>
    
    
                        </div>
    
                    </div>
                    <div class="uDetails" onclick="location.href='managerDetails.php'">
                        <div class="uName">
                            <h6>N/A</h6>
    
                        </div>
                        <div class="uBooked">
                            <h6>N/A</h6>
    
    
                        </div>
                        <div class="uDate">
                            <h6>N/A</h6>
    
    
                        </div>
    
                    </div>
                    <div class="uDetails" onclick="location.href='managerDetails.php'">
                        <div class="uName">
                            <h6>N/A</h6>
    
                        </div>
                        <div class="uBooked">
                            <h6>N/A</h6>
    
    
                        </div>
                        <div class="uDate">
                            <h6>N/A</h6>
    
    
                        </div>
    
                    </div>
                    <div class="uDetails" onclick="location.href='managerDetails.php'">
                        <div class="uName">
                            <h6>N/A</h6>
    
                        </div>
                        <div class="uBooked">
                            <h6>N/A</h6>
    
    
                        </div>
                        <div class="uDate">
                            <h6>N/A</h6>
    
    
                        </div>
    
                    </div>
                    <div class="uDetails" onclick="location.href='managerDetails.php'">
                        <div class="uName">
                            <h6>N/A</h6>
    
                        </div>
                        <div class="uBooked">
                            <h6>N/A</h6>
    
    
                        </div>
                        <div class="uDate">
                            <h6>N/A</h6>
    
    
                        </div>
    
                    </div>
                     
                        
                      
                       
                   </div>
                    
                
            
                

            </div>
            <!-- End of Admin Screen Element -->

            <!-- Calender Element -->
            <div class = 'calender full-hw flex-col flex-center p-rel'>

                <div class = 'close-btn flex-center p-abs top-right' onclick = 'deactivate(".calender");'>
                    <i class = 'bi bi-x-lg p-1'></i>
                </div>

                <div class = 'date-btn start-btn full-w'>
                    <div class = 'btn'>START DATE</div>
                    <div class = 'value'>15th Feb 2022</div>
                </div>

                <div class = 'date-btn end-btn full-w'>
                    <div class = 'value'>15th Feb 2022</div>
                    <div class = 'btn'>END DATE</div>
                </div>
                
            </div>
            <!-- End of Calender Element -->
        </main>

</div>


    <script>
        function toggle_items(item_name){
            element = document.querySelector(item_name);
            element.classList.toggle("active");
        }


    </script>

    <script src = 'js/index.js'></script>
</body>
</html>