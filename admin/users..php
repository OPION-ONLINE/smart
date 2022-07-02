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
    <div class="cover2">
        <div class="userInformation">
            <div class="userDetails">
    
             <div class="element">
                 <div class="lable">
                     <h4>User ID</h4>
                 </div>
                 <div class="lableInfo">
                     <input type="text">
                     
                 </div>
    
            </div>
                 
    
                <div class="element">
                     <div class="lable">
                         <h4>Full Name</h4>
                     </div>
                     <div class="lableInfo">
                         <input type="text">
                         
                     </div>
    
                </div>
    
                <div class="element">
                 <div class="lable">
                     <h4>Gender</h4>
                 </div>
                 <div class="lableInfo">
                     <input type="text">
                     
                 </div>
    
            </div>
    
            <div class="element">
             <div class="lable">
                 <h4>Email Address</h4>
             </div>
             <div class="lableInfo">
                 <input type="text">
                 
             </div>
    
        </div>
        <div class="element">
             <div class="lable">
                 <h4>Date of Birth</h4>
             </div>
             <div class="lableInfo">
                 <input type="text">
                 
             </div>
    
        </div>
        <div class="element">
             <div class="lable">
                 <h4>Date Registered</h4>
             </div>
             <div class="lableInfo">
                 <input type="text">
                 
             </div>
    
        </div>
        
                
                 
            </div>
    
    
            <div class="userTransactions">
                <div class="line"></div>
                <h3>User Transactions</h3>
    
                <div class="element">
                 <div class="lable">
                     <h4>Number of Bookings Made</h4>
                 </div>
                 <div class="lableInfo">
                     <input type="text">
                     
                 </div>
    
    
                <div class="element">
                 <div class="lable">
                     <h4>Total Expenditure</h4>
                 </div>
                 <div class="lableInfo">
                     <input type="text">
                     
                 </div>
    
    
    
    
            </div>
    
    
            </div>
    
            </div>
    
            <div class="history">
                <div class="line"></div>

                   <h3>User History</h3>
                   <div class="overflow">
                       <div class="history2">
                           <div class="element2">
                               <div class="header">
                                   <h6>Booking ID</h6>
                               </div>
                                 <div class="item">
                                     <input type="text">
                                 </div>
                           </div>
                           <div class="element2">
                            <div class="header">
                                <h6>Asset Name</h6>
                            </div>
                             <div class="item">
                                 <input type="text">
                             </div>
                        </div>
                        <div class="element2">
                            <div class="header">
                                <h6>Asset Type</h6>
                            </div>
                             <div class="item">
                                 <input type="text">
                             </div>
                        </div>
                        <div class="element2">
                            <div class="header">
                                <h6>Date Booked</h6>
                            </div>
                             <div class="item">
                                 <input type="text">
                             </div>
                        </div>
                        <div class="element2">
                            <div class="header">
                                <h6>State</h6>
                            </div>
                             <div class="item">
                                 <input type="text">
                             </div>
                        </div>

                       </div>

                
                        
                       
                   </div>
               </div>
        </div>


        <div class="updateButton">
            <div class="uBtn" onclick="toggle_items('.cover2')">
            <h6>UPDATE</h6>

            </div>
            <div class="uBtn" onclick="toggle_items('.cover2')">
                <h6>CANCEL</h6>
    
                </div>
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

            </div>of Menu Element -->

            <!-- Admin Screen Element -->
            <div class = 'right full-vh full-w' >

                <div class = 'nav-bar full-w flex-row flex-between'>

                    <div class = 'left flex-row'>
                        <div class = 'menu-btn flex-row' onclick = 'activate("main > .left"); deactivate(".calender");'>
                            <i class = 'bi bi-grid-fill'></i>
                        </div>
                        <div class = 'panel-name'>User Details</div>
                    </div>
                    <div class = 'right'>
                        <div class = 'date-btn flex-row' onclick = 'activate(".calender"); deactivate("main > .left");'>
                            <i class = 'bi bi-calendar3'></i>
                            <span>Calender</span>
                        </div>
                    </div>

                </div>

            <!-- User Elemnt Begins-->
               <div class="users">
                   <div class="edit" onclick="toggle_items('.cover2')">
                       <h6>Edit</h6>
                   </div>
                   <div class="cover">
                       <div class="userInformation">
                           <div class="userDetails">

                            <div class="element">
                                <div class="lable">
                                    <h4>User ID</h4>
                                </div>
                                <div class="lableInfo">
                                    <p>N/A</p>
                                    
                                </div>

                           </div>
                                

                               <div class="element">
                                    <div class="lable">
                                        <h4>Full Name</h4>
                                    </div>
                                    <div class="lableInfo">
                                        <p>N/A</p>
                                        
                                    </div>

                               </div>

                               <div class="element">
                                <div class="lable">
                                    <h4>Gender</h4>
                                </div>
                                <div class="lableInfo">
                                    <p>N/A</p>
                                    
                                </div>

                           </div>

                           <div class="element">
                            <div class="lable">
                                <h4>Email Address</h4>
                            </div>
                            <div class="lableInfo">
                                <p>N/A</p>
                                
                            </div>

                       </div>
                       <div class="element">
                            <div class="lable">
                                <h4>Date of Birth</h4>
                            </div>
                            <div class="lableInfo">
                                <p>N/A</p>
                                
                            </div>

                       </div>
                       <div class="element">
                            <div class="lable">
                                <h4>Date Registered</h4>
                            </div>
                            <div class="lableInfo">
                                <p>N/A</p>
                                
                            </div>

                       </div>
                       
                               
                                
                           </div>


                           <div class="userTransactions">
                               <div class="line"></div>
                               <h3>User Transactions</h3>

                               <div class="element">
                                <div class="lable">
                                    <h4>Number of Bookings Made</h4>
                                </div>
                                <div class="lableInfo">
                                    <p>N/A</p>
                                    
                                </div>


                               <div class="element">
                                <div class="lable">
                                    <h4>Total Expenditure</h4>
                                </div>
                                <div class="lableInfo">
                                    <p>N/A</p>
                                    
                                </div>

 


                           </div>


                           </div>

                           </div>

                           <div class="history">
                            <div class="line"></div>

                               <h3>User History</h3>
                               <div class="overflow">
                                   <div class="history2">
                                       <div class="element2">
                                           <div class="header">
                                               <h6>Booking ID</h6>
                                           </div>
                                             <div class="item">
                                                 <p>N/A</p>
                                             </div>
                                       </div>
                                       <div class="element2">
                                        <div class="header">
                                            <h6>Asset Name</h6>
                                        </div>
                                         <div class="item">
                                             <p>N/A</p>
                                         </div>
                                    </div>
                                    <div class="element2">
                                        <div class="header">
                                            <h6>Asset Type</h6>
                                        </div>
                                         <div class="item">
                                             <p>N/A</p>
                                         </div>
                                    </div>
                                    <div class="element2">
                                        <div class="header">
                                            <h6>Date Booked</h6>
                                        </div>
                                         <div class="item">
                                             <p>N/A</p>
                                         </div>
                                    </div>
                                    <div class="element2">
                                        <div class="header">
                                            <h6>Booking State</h6>
                                        </div>
                                         <div class="item">
                                             <p>N/A</p>
                                         </div>
                                    </div>

                                   </div>

                            
                                    
                                   
                               </div>
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
        function toggle_items(item_name){
            element = document.querySelector(item_name);
            element.classList.toggle("active");
        }


    </script>

    <script src = 'js/index.js'></script>
</body>
</html>