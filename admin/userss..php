<?php require_once "templates/session.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>

    <link rel = 'stylesheet' href = 'css/general.css'>
    <link rel = 'stylesheet' href = 'css/booking.css'>
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
            <div class = 'right full-vh full-w'>

                <div class = 'nav-bar full-w flex-row flex-between'>

                    <div class = 'left flex-row'>
                        <div class = 'menu-btn flex-row' onclick = 'activate("main > .left"); deactivate(".calender");'>
                            <i class = 'bi bi-grid-fill'></i>
                        </div>
                        <div class = 'panel-name'>Users</div>
                    </div>
                    <div class = 'right'>
                        <div class = 'date-btn flex-row' onclick = 'activate(".calender"); deactivate("main > .left");'>
                            <i class = 'bi bi-calendar3'></i>
                            <span>Calender</span>
                        </div>
                    </div>

                </div>

                <div class = 'tool-bar flex-row flex-end'>
                    <div class = 'search-bar'>
                        <div class = 'input flex-row'>
                            <div class = 'icon'>
                                <i class = 'bi bi-search'></i>
                            </div>

                            <input type = 'text' name = 'supplier-search' placeholder="Search For A Supplier Here">
                        </div>
                    </div>
                </div>
                
                <div class = 'table-container'>
                    <div class = 'table-head'>
                        <div class = 'th th-name'>Name</div>
                        <div class = 'th th-number'>Number</div>
                        <div class = 'th th-location'>Location</div>
                        <div class = 'th th-date'>Date</div>
                        <div class = 'th th-action'>Action</div>
                    </div>

                    <div class = 'table'>
                        <div class = 'table-entry'>
                            <div class = 'te te-name'>Name Of The User</div>
                            <div class = 'te te-number'>05534002384</div>
                            <div class = 'te te-location'>Location Selected</div>
                            <div class = 'te te-date'>15th nov 2021</div>
                            <div class = 'te te-action'>
                                <div class = 'btn' onclick = 'location.href = "usersList.php";'>Edit</div>
                            </div>
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
        let parent = document.querySelector(".table");

        let element = parent.innerHTML;

        for(i = 0; i < 20; i++) {
            parent.innerHTML += element;
        }
    </script>

    <script src = 'js/index.js'></script>
</body>
</html>