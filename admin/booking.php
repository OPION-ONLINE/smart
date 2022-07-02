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
<div class = 'loader p-fix top-left full-vhw z-5 flex-center'>
        <div class = 'img' style = 'width: auto; height: 60px'>
            <img src = 'images/loading-icon-transparent-background-12.gif' class = 'full-h'>
        </div>
    </div>
    
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
                        <div class = 'panel-name'>Booking</div>
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

                            <input type = 'text' name = 'supplier-search' placeholder="Search For A Booking Here" oninput = 'search_booking(this.value); console.log("changing...");'>
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
                                <div class = 'btn' onclick = 'activate(".view-booking-details");'>Edit</div>
                            </div>
                        </div>
                    </div>

                    <div class = 'show-more-btn flex-row flex-end'>
                        <div class = 'btn' onclick = 'show_more();'>Show More</div>
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
                    <div class = 'btn' >START DATE</div>
                    <input type = 'date' name = 'start-date' class = 'start-date value' oninput="calender_bookings()" >
                    <!-- <div class = 'value'>15th Feb 2022</div> -->
                </div>

                <div class = 'date-btn end-btn full-w'>
                    <input type = 'date' name = 'end-date' class = 'end-date value' oninput="calender_bookings()">
                    <!-- <div class = 'value'>15th Feb 2022</div> -->
                    <div class = 'btn'>END DATE</div>
                </div>
                
            </div>
            <!-- End of Calender Element -->

            <!-- View Booking Details Container -->
            <div class = 'view-booking-details p-abs top-left full-vhw flex-center'>
                <!-- White Booking Details Container -->
                <div class = 'modal-container'>
                    <!-- Top section including the title and close button -->
                    <div class = 'modal-top flex-row flex-between p-1'>
                        <div class = 'title'>Booking Details</div>
                        <div class = 'modal-close-btn' onclick = 'deactivate(".view-booking-details");'>
                            <i class = 'bi bi-x-lg'></i>
                        </div>
                    </div>

                    <!-- Section including the modal details -->
                    <div class = 'modal-content full-w p-1'>
                        <div class = 'modal-detail'>
                            <div class = 'detail-name'>Name Of Facility</div>
                            <div class = 'detail-content fname'>Honesty Students Hostel</div>
                        </div>

                        <div class = 'modal-detail'>
                            <div class = 'detail-name'>Facility Type</div>
                            <div class = 'detail-content ftype'>Hostel</div>
                        </div>

                        <div class = 'modal-detail'>
                            <div class = 'detail-name'>Facility Location</div>
                            <div class = 'detail-content floc'>Panopticon WestVille</div>
                        </div>

                        <div class = 'modal-detail'>
                            <div class = 'detail-name'>Selected Floor</div>
                            <div class = 'detail-content ffloor'>First Floor</div>
                        </div>

                        <div class = 'modal-detail'>
                            <div class = 'detail-name'>Room Type</div>
                            <div class = 'detail-content froom'>Four in a Room</div>
                        </div>

                        <div class = 'modal-detail'>
                            <div class = 'detail-name'>Booking ID</div>
                            <div class = 'detail-content bid'>#33040332</div>
                        </div>

                        <div class = 'modal-detail'>
                            <div class = 'detail-name'>Booking State</div>
                            <div class = 'detail-content bstate'>Honesty Students Hostel</div>
                        </div>

                        <div class = 'modal-detail'>
                            <div class = 'detail-name'>Scheduled Date</div>
                            <div class = 'detail-content sdate'>#33040332</div>
                        </div>

                        <div class = 'modal-detail'>
                            <div class = 'detail-name'>User's Name</div>
                            <div class = 'detail-content uname'>Mr Frank Edward</div>
                        </div>

                        <div class = 'modal-detail'>
                            <div class = 'detail-name'>User's Email</div>
                            <div class = 'detail-content uemail'>MrFrankEdward@gmail.com</div>
                        </div>

                        <div class = 'modal-detail'>
                            <div class = 'detail-name'>User's Number</div>
                            <div class = 'detail-content unumber'>0508527319</div>
                        </div>

                        <div class = 'modal-detail'>
                            <div class = 'detail-name'>Amount Paid</div>
                            <div class = 'detail-content uamount'>GHC-3650</div>
                        </div>

                        <div class = 'modal-action'>
                            <div class = 'approve-btn btn' onclick = 'approve_booking();'>Approve Booking</div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </main>

</div>
    <script>
        let parent = document.querySelector(".table");

        let element = parent.innerHTML;

        for(i = 0; i < 20; i++) {
            parent.innerHTML += element;
        }
    </script>

    <script src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src = 'js/index.js'></script>
    <script src = '../backend/handlers/booking_handler/js/admin_handler.js'></script>
</body>
</html>
