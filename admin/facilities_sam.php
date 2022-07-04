<?php require_once "templates/session.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel = 'stylesheet' href = 'css/general.css'>
    <link rel = 'stylesheet' href = 'css/facilities.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <div class = 'panel-name'>Permissions</div>
                    </div>
                    <div class = 'right'>
                        <div class = 'date-btn flex-row' onclick = 'activate(".calender"); deactivate("main > .left");'>
                            <i class = 'bi bi-calendar3'></i>
                            <span>Calender</span>
                        </div>
                    </div>

                </div>

              
                
                       
                   <!--Modal start-->

                    <button type="button" class="btn btn-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><span class="">Add New</span></button>
        
                    
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Property</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form>

                                  <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label"><span class="fw-bold">Facility Name</span></label>
                                    <input type="text" class="form-control border border-radius-5 " id="recipient-name" placeholder="Enter Facility name">
                                  </div>
                                  <div class="mb-3">
                                    <label for="message-text" class="col-form-label"><span class="fw-bold">DESCRIPTION</span></label>
                                    <textarea class="form-control border border-radius-5 " id="message-text"></textarea>
                                  </div>
                                  <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg ">
                                    <option selected>Facility Type</option>
                                    <option value="1" default>Hotel</option>
                                    <option value="2">Hostels</option>
                                    <option value="3">Homestels</option>
                                    <option value="">Guest House</option>

                                  </select>
                                  <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label"><span class="fw-bold">Number of rooms</span></label>
                                    <input type="number" class="form-control border border-radius-5 " id="recipient-name" placeholder="Enter Number of rooms" min="1" max="100">
                                  </div>
                               
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Done</button>
                          </div>
                        </div>
                      </div>
                    </div>



  <!--Modal END-->


  <div class = 'tool-bar flex-row flex-around flex-wrap'>


                    <div class = 'search-bar flex-row' >
                        <div class = 'filter-box p-rel'>
                            <div class = 'filter-value flex-row flex-between' onclick = ''>
                                <span class = 'flex-center'>Search Filter</span>
                                <div class = 'icon flex-center'>
                                    <i class = 'bi bi-chevron-down'></i>
                                </div>
                            </div>
                            <div class = 'filter-items p-abs'>
                                <div class = 'filter-item' onclick = 'set_value("Filter by Type", ".filter-value span"); deactivate(".filter-items")' tabindex="0">TYPE</div>
                                <div class = 'filter-item' onclick = 'set_value("Filter by Name", ".filter-value span"); deactivate(".filter-items")' tabindex="1">NAME</div>
                                <div class = 'filter-item' onclick = 'set_value("Filter by Contact", ".filter-value span"); deactivate(".filter-items")' tabindex="2">CONTACT</div>
                                <div class = 'filter-item' onclick = 'set_value("Filter by Location", ".filter-value span"); deactivate(".filter-items")' tabindex="3">LOCATION</div>
                                
                            </div>
                        </div>
                        <div class = 'input flex-row'>
                            <div class = 'icon'>
                                <i class = 'bi bi-search'></i>
                            </div>

                            <input type = 'text' name = 'supplier-search' placeholder="Type Your Search Here..." style = 'border: none; margin: 0;box-shadow: none;'>
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
                            <div class = 'te te-name'>Name Of The Facility</div>
                            <div class = 'te te-number'>05534002384</div>
                            <div class = 'te te-location'>Location Selected</div>
                            <div class = 'te te-date'>15th nov 2021</div>
                            <div class = 'te te-action'>
                                <div class = 'btn' onclick = 'activate(".add-item-container");'>Edit</div>
                            </div>
                        </div>
                    </div>
                </div>
<!---
                <div class = 'add-item-container full-vhw p-fix top-left flex-center' >

                    <div class = 'add-item-box p-rel'>
                        <div class = 'close-btn flex-center p-abs top-right' onclick = 'deactivate(".add-item-container");'>
                            <i class = 'bi bi-x-lg'></i>
                        </div>

                        

                        <div class = 'input-container flex-col'>
                            <div class = 'input input title flex-col'>
                                <label>Facility Name</label>
                                <input type = 'text' name = 'facility-name' placeholder = 'Type in the facility name here...'>
                            </div>
    
                            <div class = 'input textbox flex-col'>
                                <label>Facility Description</label>
                                <textarea type = 'text' name = 'facility-description' placeholder= 'Type in the facility description here...'></textarea>
                            </div>
    
                            <div class = 'input input-md dropdown flex-col'>
                                <label>Select Facility Type</label>
                                <div class = 'dropdown p-rel'>
                                    <div class = 'dropdown-value flex-row flex-between' onclick = 'toggle_itm(".dropdown-items"); toggle_itm(".dropdown-value");'>
                                        <span>Hostel - Default</span>
                                        <i class = 'bi bi-chevron-down'></i>
                                    </div>
                                    <div class = 'dropdown-items p-abs'>
                                        <div class = 'dropdown-item' onclick = 'deactivate(".dropdown-items");'>Hostel</div>
                                        <div class = 'dropdown-item' onclick = 'deactivate(".dropdown-items");'>Homstel</div>
                                        <div class = 'dropdown-item' onclick = 'deactivate(".dropdown-items");'>Hotel</div>
                                    </div>
                                </div>
                            </div>

                            <div class = 'input many-of-type'>
                                <label>Add Facility Floors</label>

                                <div class = 'type-items'>
                                    <div class = 'type-item'>
                                        <div class = 'type-images'>
                                            <div class = 'type-image'>
                                                <div class = 'img'>
                                                    <img src = 'images/image-upload.gif' class = 'obj-fit'>
                                                </div>
                                                <div class = 'txt text-center'>Upload Outer View Image </div>
                                            </div>

                                            <div class = 'type-image'>
                                                <div class = 'img'>
                                                    <img src = 'images/image-upload.gif' class = 'obj-fit'>
                                                </div>
                                                <div class = 'txt text-center'>Upload Room View Image </div>
                                            </div>
                                            
                                            <div class = 'type-image'>
                                                <div class = 'img'>
                                                    <img src = 'images/image-upload.gif' class = 'obj-fit'>
                                                </div>
                                                <div class = 'txt text-center'>Upload Lavatory View Image</div>
                                            </div>
                                        </div>

                                        <div class = 'type-input'>
                                            <div class = 'input flex-col'>
                                                <label>Floor Name</label>
                                                <input type = 'text' name = 'floor-name' placeholder = 'E.g First Floor'>
                                            </div>

                                            <div class = 'input input-md dropdown flex-col'>
                                                <label>Select Facility Type</label>
                                                <div class = 'dropdown p-rel'>
                                                    <div class = 'dropdown-value flex-row flex-between' onclick = 'toggle_itm(".type-input .dropdown-items"); toggle_itm(".type-input .dropdown-value");'>
                                                        <span>Room type E.g Four in a room</span>
                                                        <i class = 'bi bi-chevron-down'></i>
                                                    </div>
                                                    <div class = 'dropdown-items p-abs'>
                                                        <div class = 'dropdown-item' onclick = 'deactivate(".type-input .dropdown-items");'>Room Type 1</div>
                                                        <div class = 'dropdown-item' onclick = 'deactivate(".type-input .dropdown-items");'>Room Type 2</div>
                                                        <div class = 'dropdown-item' onclick = 'deactivate(".type-input .dropdown-items");'>Room Type 4</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class = 'input flex-col'>
                                                <label>Price</label>
                                                <input type = 'number' name = 'floor-name' placeholder = 'E.g First Floor'>
                                            </div>

                                            <div class = 'add-type-btn flex-row flex-between' style = 'height: 60px;' onclick = 'type_remove();'>
                                                <span>Add Floor</span>
                                                <div class = 'icon'>
                                                    <i class = 'bi bi-minus-circle'></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div> 
                                </div>

                                <div class = 'add-type-btn flex-row flex-between' onclick = 'type_add();'>
                                    <span>Add Floor</span>
                                    <div class = 'icon'>
                                        <i class = 'bi bi-plus-circle'></i>
                                    </div>
                                </div>
                            </div>
    
                        </div>

                        <div class = 'done-btn flex-center' onclick = 'deactivate(".add-item-container");'>
                            <span>DONE</span>
                        </div>
                    </div>

                </div>

            </div>--->
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

        let type = document.querySelector(".type-items");
        element = type.innerHTML;

        type.innerHTML = '';
        type_count = 0;

        function type_add() {
            type.innerHTML += `
                <div class = 'type-item p-rel' facility_type = ${type_count}>

                    <div class = 'remove-type-btn flex-row flex-between p-abs top-right p-1' style = 'height: 60px;' onclick = 'type_remove(${type_count});'>
                        <span>Remove Floor</span>
                        <div class = 'icon'>
                            <i class = 'bi bi-trash3-fill'></i>
                        </div>
                    </div>

                    <div class = 'type-images'>
                        <div class = 'type-image'>
                            <div class = 'img'>
                                <img src = 'images/image-upload.gif' class = 'obj-fit'>
                            </div>
                            <div class = 'txt text-center'>Upload Outer View Image </div>
                        </div>

                        <div class = 'type-image'>
                            <div class = 'img'>
                                <img src = 'images/image-upload.gif' class = 'obj-fit'>
                            </div>
                            <div class = 'txt text-center'>Upload Room View Image </div>
                        </div>
                        
                        <div class = 'type-image'>
                            <div class = 'img'>
                                <img src = 'images/image-upload.gif' class = 'obj-fit'>
                            </div>
                            <div class = 'txt text-center'>Upload Lavatory View Image</div>
                        </div>
                    </div>

                    <div class = 'type-input'>
                        <div class = 'input flex-col'>
                            <label>Floor Name</label>
                            <input type = 'text' name = 'floor-name' placeholder = 'E.g First Floor'>
                        </div>

                        <div class = 'input input-md dropdown flex-col'>
                            <label>Select Facility Type</label>
                            <div class = 'dropdown p-rel'>
                                <div class = 'dropdown-value flex-row flex-between' onclick = "toggle_itm('.type-item[facility_type = \\'${type_count}\\'] .type-input .dropdown-items'); toggle_itm('.type-item[facility_type = \\'${type_count}\\'] .type-input .dropdown-value');">
                                    <span>Room type E.g Four in a room</span>
                                    <i class = 'bi bi-chevron-down'></i>
                                </div>
                                <div class = 'dropdown-items p-abs'>
                                    <div class = 'dropdown-item' onclick = 'deactivate(".type-item[facility_type = \\"${type_count}\\"] .type-input .dropdown-items");'>Room Type 4</div>
                                    <div class = 'dropdown-item' onclick = 'deactivate(".type-item[facility_type = \\"${type_count}\\"] .type-input .dropdown-items");'>Room Type 1</div>
                                    <div class = 'dropdown-item' onclick = 'deactivate(".type-item[facility_type = \\"${type_count}\\"] .type-input .dropdown-items");'>Room Type 2</div>
                                </div>
                            </div>
                        </div>

                        <div class = 'input flex-col'>
                            <label>Price</label>
                            <input type = 'number' name = 'floor-name' placeholder = 'E.g First Floor'>
                        </div>

                        <div class = 'input flex-col'>
                            <label>Number of rooms</label>
                            <input type = 'number' name = 'number-of-rooms' placeholder = 'E.g 10'>
                        </div>

                        
                    </div>

                </div>
            `;
            type_count++;
        }

        function type_remove(number) {
            document.querySelector(`[facility_type = "${number}"]`).remove();
        }

        

        
    </script>

    <script src = 'js/index.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
