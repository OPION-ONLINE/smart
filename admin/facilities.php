<?php require_once "templates/session.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel = 'stylesheet' href = 'css/general.css'>
    <link rel = 'stylesheet' href = 'css/dropdown.css'>
    <link rel = 'stylesheet' href = 'css/facilities.css'>
    <link rel = 'stylesheet' href = 'css/new_facility.css'>
    <link rel = 'stylesheet' href = 'css/image_server.css'>
</head>
<body>
<div class = 'wrapper'>

    <div class = 'loader p-fix top-left full-vhw z-5 flex-center'>
        <div class = 'img' style = 'width: auto; height: 60px'>
            <img src = 'images/loading-icon-transparent-background-12.gif' class = 'full-h'>
        </div>
    </div>

        <main class='full-vhw bg p-rel z-1'>
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
                        <div class = 'panel-name'>Facilities</div>
                    </div>
                    <div class = 'right'>
                        <div class = 'date-btn flex-row' onclick = 'activate(".calender"); deactivate("main > .left");'>
                            <i class = 'bi bi-calendar3'></i>
                            <span>Calender</span>
                        </div>
                    </div>

                </div>

                <div class = 'tool-bar flex-row flex-around flex-wrap'>
                    <div class = 'add-btn flex-row flex-center' onclick = 'add_new_facility_btn();'>
                        <div class = 'icon'>
                            <i class = 'bi bi-plus-circle'></i>
                        </div>
                        <span>Add New</span>
                    </div>
                    <div class = 'search-bar flex-row' >
                        <!-- <div class = 'filter-box p-rel'>
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
                        </div> -->
                        <div class = 'input flex-row'>
                            <div class = 'icon'>
                                <i class = 'bi bi-search'></i>
                            </div>

                            <input type = 'text' name = 'search_query' placeholder="Type Your Search Here..." style = 'border: none; margin: 0;box-shadow: none;' oninput = 'search_facilities(this.value); console.log("changing...");'>
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
                                <div class = 'btn' onclick = 'activate(".facility-modal-case");'>Edit</div>
                            </div>
                        </div>
                    </div>
                    <div class = 'show-more-btn flex-row flex-end'>
                        <div class = 'btn' onclick = 'show_more();'>Show More</div>
                    </div>
                </div>


            <!-- This is the facility modal for adding and edditing facilities -->
            <div class = 'facility-modal-case full-hw p-abs top-left flex-center z-1'>
                <!-- White facility modal at the center -->
                <div class = 'facility-modal ov-hidden p-rel z-2'>
                    <!-- Modal top containing the close button -->
                    <div class = 'modal-top flex-row flex-between p-1'>
                        <div class = 'modal-name'>FACILITY</div>
                        <!-- Close button -->
                        <div class = 'close-btn' onclick = 'deactivate(".facility-modal-case");'>
                            <i class = 'bi bi-x-lg'></i>
                        </div>
                    </div>
                    <!-- Contains content of modal -->
                    <div class = 'modal-content full-w p-1 p-rel'>
                        <div class = 'modal-entry'>
                            <div class = 'modal-entry-name'>FACILITY NAME</div>
                            <div class = 'modal-input'>
                                <input class = 'full-hw' name = 'facility_name' type = 'text' placeholder = 'Enter Facility Name'>
                            </div>
                        </div>

                        <div class = 'modal-entry p-rel z-1 facility_type'>
                            <div class = 'modal-entry-name'>FACILITY TYPE</div>
                            <div class = 'modal-input'>
                                <div class = 'dropdown-case p-rel flex-row p-1'>
                                    <div class = 'dropdown-value flex-row flex-between full-w' onclick = 'toggle_itm(".dropdown-items"); toggle_itm(".dropdown-value");'>
                                        <span>Hostel</span>
                                        <i class = 'bi bi-chevron-down'></i>
                                    </div>
                                    <div class = 'dropdown-items p-abs ov-hidden'>
                                        <div class = 'dropdown-item flex-row' onclick = 'set_value("Hostel", ".dropdown-value span"); deactivate(".dropdown-items"); deactivate(".dropdown-value");'>
                                            <span>Hostel</span>
                                        </div>
                                        <div class = 'dropdown-item flex-row' onclick = 'set_value("Homestel", ".dropdown-value span"); deactivate(".dropdown-items"); deactivate(".dropdown-value");'>
                                            <span>Homestel</span>
                                        </div>
                                        <div class = 'dropdown-item flex-row' onclick = 'set_value("Hotel", ".dropdown-value span"); deactivate(".dropdown-items"); deactivate(".dropdown-value");'>
                                            <span>Hotel</span>
                                        </div>
                                        <div class = 'dropdown-item flex-row' onclick = 'set_value("Guest House", ".dropdown-value span"); deactivate(".dropdown-items"); deactivate(".dropdown-value");'>
                                            <span>Guest House</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = 'modal-entry'>
                            <div class = 'modal-entry-name'>FACILITY CONTACT</div>
                            <div class = 'modal-input'>
                                <input class = 'full-hw' name = 'facility_contact' type = 'number' placeholder = 'Enter Facility Contact'>
                            </div>
                        </div>

                        <div class = 'modal-entry'>
                            <div class = 'modal-entry-name'>FACILITY LOCATION</div>
                            <div class = 'modal-input'>
                                <input class = 'full-hw' name = 'facility_location' type = 'text' placeholder = 'Enter Facility Name'>
                            </div>
                        </div>

                        <div class = 'modal-entry'>
                            <div class = 'modal-entry-name'>FACILITY DESCRIPTION</div>
                            <div class = 'modal-input'>
                                <textarea class = 'full-hw' name = 'facility_description' type = 'text' placeholder = 'Enter Facility Description'></textarea>
                            </div>
                        </div>

                        <div class = 'modal-entry p-rel z-1 facility_state'>
                            <div class = 'modal-entry-name'>FACILITY STATE</div>
                            <div class = 'modal-input'>
                                <div class = 'dropdown-case p-rel flex-row p-1'>
                                    <div class = 'dropdown-value flex-row flex-between full-w' onclick = 'toggle_itm(".facility_state .dropdown-items"); toggle_itm(".facility_state .dropdown-value");'>
                                        <span>Inactive</span>
                                        <i class = 'bi bi-chevron-down'></i>
                                    </div>
                                    <div class = 'dropdown-items p-abs ov-hidden'>
                                        <div class = 'dropdown-item flex-row' onclick = 'set_value("Active", ".facility_state .dropdown-value span"); deactivate(".facility_state .dropdown-items"); deactivate(".facility_state .dropdown-value");'>
                                            <span>Active</span>
                                        </div>

                                        <div class = 'dropdown-item flex-row' onclick = 'set_value("Inactive", ".facility_state .dropdown-value span"); deactivate(".facility_state .dropdown-items"); deactivate(".facility_state .dropdown-value");'>
                                            <span>Inactive</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = 'modal-entry flex-row add' onclick = 'activate(".modal-sub-modal")'>
                            <div class = 'modal-add-btn flex-center round p-rel z-2'>
                                <i class = 'bi bi-plus-circle '></i>
                            </div>
                            <div class = 'modal-add-btn-txt p-rel z-1' >Add Floor</div>
                        </div>

                        

                        
                    </div>

                    <!-- This is the sub modal for the parent modal helps to add floor -->
                    <div class = 'modal-sub-modal modal-content p-abs top-left full-hw z-2'>
                        <!-- Sub-modal top containing the close button -->
                        <div class = 'modal-top flex-row flex-between p-1'>
                            <div class = 'modal-name'>FLOOR</div>
                            <div class = 'close-btn' onclick = 'close_floor();'>
                                <i class = 'bi bi-x-lg'></i>
                            </div>
                        </div>

                        <div class = 'modal-content full-w p-1 p-rel'>
                            <div class = 'modal-entry'>
                                <div class = 'modal-entry-name'>FLOOR NAME</div>
                                <div class = 'modal-input'>
                                    <input class = 'full-hw' type = 'text' name = 'floor_name' placeholder = 'Enter Floor Name'>
                                </div>
                            </div>
        
                            <div class = 'modal-entry'>
                                <div class = 'modal-entry-name'>ROOM TYPE</div>
                                <div class = 'modal-input'>
                                    <input class = 'full-hw' type = 'text' name = 'room_type' placeholder = 'Enter Room Type'>
                                </div>
                            </div>

                            <div class = 'modal-entry'>
                                <div class = 'modal-entry-name'>ROOM PRICE</div>
                                <div class = 'modal-input'>
                                    <input class = 'full-hw' type = 'number' name = 'room_price' placeholder = 'Enter Room Price'>
                                </div>
                            </div>
        
                            <div class = 'modal-entry'>
                                <div class = 'modal-entry-name'>NUMBER OF ROOMS</div>
                                <div class = 'modal-input'>
                                    <input class = 'full-hw' type = 'number' name = 'num_of_rooms' placeholder = 'Enter Number Of Rooms'>
                                </div>
                            </div>

                            <div class = 'modal-entry flex-row add add-image' onclick = 'toggle_class(".add-image-box", "active", "deactive")'>
                                <div class = 'modal-add-btn flex-center round p-rel z-2'>
                                    <i class = 'bi bi-plus-circle '></i>
                                </div>
                                <div class = 'modal-add-btn-txt p-rel z-1'>Add Images</div>
                            </div>
                            
                        </div>

                        <!-- Bottom section of the sub modal -->
                        <div class = 'modal-bottom'>
                            <div class = 'btn flex-center' onclick = 'remove_room();'>REMOVE ROOM</div>
                            <div class = 'btn flex-center' onclick = 'add_floor();'>ADD ROOM</div>
                        </div>

                    </div>

                    <!-- Bottom section of the parent modal -->
                    <div class = 'modal-bottom add_facility_modal_bottom'>
                        <div class = 'btn flex-center remove_facility_btn'>REMOVE FACILITY</div>
                        <div class = 'btn flex-center add_facility_btn' onclick = 'add_facility();'>ADD FACILITY</div>
                    </div>
                </div>

                <!-- Add image element for room -->
                <div class = 'add-image-box p-abs z-1'>
                    <div class = 'box full-hw'>
                        <div class = 'p-rel' onclick = 'activate(".image_server"); set_target(this);'>
                            <img src = 'images/image-upload.gif' class = 'obj-fit p-rel z-1 facility_image'>
                            <div class = 'click-img p-abs bottom-left full-w flex-center z-2'>
                                Facility Image
                            </div>
                        </div>

                        <div class = 'p-rel' onclick = 'activate(".image_server"); set_target(this);'>
                            <img src = 'images/image-upload.gif' class = 'obj-fit p-rel z-1 room_view'>
                            <div class = 'click-img p-abs bottom-left full-w flex-center z-2'>
                                Room View
                            </div>
                        </div>
                        <div class = 'p-rel' onclick = 'activate(".image_server"); set_target(this);'>
                            <img src = 'images/image-upload.gif' class = 'obj-fit p-rel z-1 outer_view'>
                            <div class = 'click-img p-abs bottom-left full-w flex-center z-2'>
                                Outer View
                            </div>
                        </div>
                        <div class = 'p-rel' onclick = 'activate(".image_server"); set_target(this);'>
                            <img src = 'images/image-upload.gif' class = 'obj-fit p-rel z-1 lavatory_view'>
                            <div class = 'click-img p-abs bottom-left full-w flex-center z-2'>
                                Lavatory View
                            </div>
                        </div>
                        <div class = 'p-rel' onclick = 'add_image_to_gallery(this);'>
                            <img src = 'images/image-upload.gif' class = 'obj-fit p-rel z-1 image_gallery'>
                            <div class = 'click-img p-abs bottom-left full-w flex-center z-2'>
                                Image Gallery
                            </div>
                        </div>
                    </div>
                    <div class = 'close-btn p-abs top-right round flex-center'  onclick = 'toggle_class(".add-image-box", "deactive", "active")'>
                        <i class = 'bi bi-x-lg'></i>
                    </div>
                </div>
            </div>

            <!-- This is the image library modal -->
            <div class = 'image_server flex-center p-abs full-vhw ov-hidden p-abs top-left z-2'>
                <div class = 'image_panel flex-row ov-hidden p-rel'>
                    <div class = 'close-btn p-abs top-right flex-center p-1 z-5' onclick = 'deactivate(".image_server")'>
                        <i class = 'bi bi-x-lg'></i>
                    </div>
                    <div class = 'left_panel full-h'>
                        <div class = 'panel_top flex-row flex-between'>
                            <div class = 'title p-1'>
                                <h3>IMAGE LIBRARY</h3>
                            </div>
    
                            <div class = 'upload-image-btn p-1'>
                                <div class = 'btn' onclick = 'activate(".upload_box")'>Upload Image</div>
                            </div>
                        </div>
                        <div class = 'panel_preview ov-hidden'>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/background.jpg' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/getimage.ashx.jpeg' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/image-upload.gif' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/background.jpg' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/getimage.ashx.jpeg' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/background.jpg' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/getimage.ashx.jpeg' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/image-upload.gif' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/background.jpg' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/getimage.ashx.jpeg' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/background.jpg' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/getimage.ashx.jpeg' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/image-upload.gif' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/background.jpg' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/getimage.ashx.jpeg' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/background.jpg' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/getimage.ashx.jpeg' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/image-upload.gif' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/background.jpg' class = 'obj-fit'>
                            </div>
                            <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                                <img src = 'images/getimage.ashx.jpeg' class = 'obj-fit'>
                            </div>
                        </div>

                        <div>
                            <div class = 'btn'>Show More</div>
                        </div>
    
                    </div>
                    <div class = 'right_panel full-h p-rel'>
                        <div class = 'panel_focus full-hw ov-hidden'>
                            <img src = 'images/background.jpg' class = 'obj-fit focus_image'>
                        </div>
                        <div class = 'focus_btns flex-row flex-center p-abs bottom-left full-w p-1'>
                            <div class = 'del-btn btn'>Delete Image</div>
                            <div class = 'select-btn btn' onclick = 'set_image();'>Select Image</div>
                        </div>
                    </div>
    
                    <form class = 'upload_box p-abs top-left full-hw'>
                        <div class = 'upload_box_top full-w flex-row'>
                            <div class = 'btn' onclick = 'deactivate(".upload_box")'>Image Library</div>
                            <!-- <div class = 'btn'>Upload Image</div> -->
                        </div>
                        <div class = 'prompt_box full-hw flex-col flex-center'>
                            <div class = 'prompt_image'>
                                <i class = 'bi bi-images'></i>
                            </div>
                            <div class = 'prompt_text'>
                                Drag and drop or use the button to upload your image(s)
                            </div>
                            <div class = 'prompt_btn flex-row'>
                                <div class = 'btn' onclick= 'click_itm(".upload_box input[name = \"images\"]");' >Select Images</div>
                            </div>
                        </div>
    
                        <input type = 'file' name = 'images' multiple accept = 'images/*' onchange = 'handlefiles(this.files);'>
                    </form>
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
                    <input type = 'date' name = 'start-date' class = 'start-date value' oninput="calender_facilities()" >
                    <!-- <div class = 'value'>15th Feb 2022</div> -->
                </div>

                <div class = 'date-btn end-btn full-w'>
                    <input type = 'date' name = 'end-date' class = 'end-date value' oninput="calender_facilities()">
                    <!-- <div class = 'value'>15th Feb 2022</div> -->
                    <div class = 'btn'>END DATE</div>
                </div>
                
            </div>
            <!-- End of Calender Element -->
        </main>

</div>
    <!-- <script>
        let parent = document.querySelector(".table");

        let element = parent.innerHTML;

        for(i = 0; i < 20; i++) {
            parent.innerHTML += element;
        }
        
    </script> -->

    <script src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src = 'js/index.js'></script>
    <script src = 'js/image_server.js'></script>
    <script src = '../backend/handlers/facility_handler/js/admin_handler.js'></script>
</body>
</html>