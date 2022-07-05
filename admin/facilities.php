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
    <link rel = 'stylesheet' href = 'css/newfacility.css'>
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
                    <div class = 'add-btn flex-row flex-center' onclick = 'open_add()'>
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
            <div class = 'container p-abs top-left full-vhw ov-hidden'>
                <div class = 'modal-box p-abs p-center'>
                    <!-- ADD FACILITY FORM -->
                    <div class = 'form facilities p-rel full-hw'>
                
                        <h2>ADD FACILITY</h2>
                        <div class = 'input flex-col full-w'>
                            <label>F<span>acility</span> N<span>ame</span></label>
                            <input flex-col type = 'text' name = 'facility_name' placeholder="e.g Evandy Hostel">
                        </div>

                        <div class = 'input flex-col full-w'>
                            <label>F<span>acility</span> T<span>ype</span></label>
                            <select name = 'facility_type'>
                                <option selected>hostel</option>
                                <option >hotel</option>
                                <option >homestel</option>
                                <option >guesthouse</option>
                            </select>
                        </div>

                        <div class = 'input flex-col full-w'>
                            <label>F<span>acility</span> C<span>ontact</span></label>
                            <input flex-col type = 'tel' name = 'facility_contact' placeholder="e.g _23323232333">
                        </div>

                        <div class = 'input flex-col full-w'>
                            <label>F<span>acility</span> D<span>escription</span></label>
                            <textarea name = 'facility_description' placeholder="this should be a very good description :-)"></textarea>
                        </div>

                        <div class = 'input flex-col full-w'>
                            <label>F<span>acility</span> L<span>ocation</span></label>
                            <input flex-col type = 'tel' name = 'facility_location' placeholder="e.g Kotei">
                        </div>

                        <div class = 'input flex-col full-w'>
                            <label>F<span>acility</span> S<span>ate</span></label>
                            <select name = 'facility_state'>
                                <option selected>Active</option>
                                <option >Inactive</option>
                            </select>
                        </div>

                        <div class = 'input flex-col image full-w' onclick = 'activate(".image_server"); set_target(this);'>
                            <div class = 'image-box p-rel full-hw ov-hidden'>
                                <img src = 'images/upload_image.jpg' class = 'obj-fit cover_image' >
                            </div>
                        </div>

                        <div class = 'input flex-col full-w'>
                            <label>F<span>acility</span> R<span>ating</span></label>
                            <input flex-col type = 'number' name = 'rating' placeholder="e.g 4.5">
                        </div>

                        <div class = 'input flex-col full-w btn flex-center view-btn' style = 'background: #222; color: #fff; margin-top: 3rem;' onclick = 'fetch_facility();'>
                            View Blocks
                        </div>

                    </div>
                    <div class = 'btns p-abs bottom-left full-w facilities'>
                        <div class = 'btn'>ADD FACILITY</div>
                    </div>

                    <!-- ADD BLOCK FORM -->
                    <div class = 'form block p-rel full-hw flex-col flex-center in'>

                        <h2>ADD BLOCK</h2>
                        <div class = 'input flex-col full-w'>
                            <label>B<span>lock</span> N<span>ame</span></label>
                            <input flex-col type = 'text' name = 'facility_block' placeholder="e.g BLOCK-A">
                        </div>

                    </div>
                    <div class = 'btns p-abs bottom-left full-w block'>
                        <div class = 'btn'>ADD BLOCK</div>
                    </div>

                    <!-- ADD FLOOR FORM -->
                    <div class = 'form floor p-rel full-hw flex-col flex-center in'>

                        <h2>ADD FLOOR</h2>
                        <div class = 'input flex-col full-w'>
                            <label>F<span>loor</span> N<span>ame</span></label>
                            <input flex-col type = 'text' name = 'floor_name' placeholder="e.g FIRST FLOOR">
                        </div>

                    </div>
                    <div class = 'btns p-abs floor bottom-left full-w'>
                        <div class = 'btn'>ADD FLOOR</div>
                    </div>

                    <!-- ADD ROOM FORM -->
                    <div class = 'form room p-rel full-hw flex-col flex-center'>

                        <h2>ADD ROOM</h2>

                        <div class = 'input flex-col full-w'>
                            <label>R<span>oom</span> T<span>ype</span></label>
                            <input flex-col type = 'text' name = 'room_type' placeholder="e.g FIRST FLOOR">
                        </div>

                        <div class = 'input flex-col full-w'>
                            <label>G<span>ender</span> </label>
                            <select name = 'gender'>
                                <option selected>Male</option>
                                <option >Female</option>
                            </select>
                        </div>

                        <div class = 'input flex-col image full-w'  onclick = 'activate(".image_server"); set_target(this);'>
                            <label>O<span>uter</span> I<span>mage</span></label>
                            <div class = 'image-box p-rel full-hw ov-hidden'>
                                <img src = 'images/upload_image.jpg' class = 'obj-fit outer_image'>
                            </div>
                        </div>

                        <div class = 'input flex-col image full-w'  onclick = 'activate(".image_server"); set_target(this);'>
                            <label>R<span>oom</span> I<span>mage</span></label>
                            <div class = 'image-box p-rel full-hw ov-hidden'>
                                <img src = 'images/upload_image.jpg' class = 'obj-fit room_image'>
                            </div>
                        </div>

                        <div class = 'input flex-col image full-w'  onclick = 'activate(".image_server"); set_target(this);'>
                            <label>L<span>avatory</span> I<span>mage</span></label>
                            <div class = 'image-box p-rel full-hw ov-hidden'>
                                <img src = 'images/upload_image.jpg' class = 'obj-fit lavatory_image'>
                            </div>
                        </div>

                        <div class = 'input flex-col full-w'>
                            <label>R<span>oom</span> C<span>ount</span></label>
                            <input flex-col type = 'text' name = 'room_count' placeholder="e.g FIRST FLOOR">
                        </div>

                    </div>
                    <div class = 'btns p-abs bottom-left full-w room'>
                        <div class = 'btn'>ADD FLOOR</div>
                    </div>


                    <!-- ADD PLAN FORM -->
                    <div class = 'form plan p-rel full-hw  flex-col flex-center'>

                        <h2>ADD PLAN</h2>

                        <div class = 'input flex-col full-w'>
                            <label>P<span>lan</span> I<span>nfo</span> O<span>ne</span></label>
                            <input flex-col type = 'text' name = 'plan_info_one' placeholder="e.g Duration">
                        </div>

                        <div class = 'input flex-col full-w'>
                            <label>P<span>lan</span> I<span>nfo</span> T<span>wo</span></label>
                            <input flex-col type = 'number' name = 'plan_info_two' placeholder="e.g Amount/(Hotel) Start Days From Now ">
                        </div>

                        <div class = 'input flex-col full-w'>
                            <label>P<span>rice</span> </label>
                            <input flex-col type = 'number' name = 'price' placeholder="e.g Hotel Amount ">
                        </div>

                    </div>
                    <div class = 'btns p-abs bottom-left full-w plan '>
                        <div class = 'btn'>ADD PLAN</div>
                    </div>


                    <!-- PREVIEW FORM -->
                    <div class = 'form preview p-rel full-hw active flex-col flex-center'>

                        <h2>BLOCK PREVIEW</h2>

                        <div class = 'input tab flex-row flex-between full-w'>
                            <div class = 'tab-value'>BLOCK-A</div>
                            <div class = 'tab-actions flex-row'>
                                <div class = 'action-btn flex-center'>
                                    <span>Edit</span>
                                    <i class = 'bi bi-arrows-fullscreen'></i>
                                </div>

                                <div class = 'action-btn flex-center'>
                                    <span>Add</span>
                                    <i class = 'bi bi-eye-fill'></i>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class = 'btns p-abs bottom-left full-w preview active'>
                        <div class = 'btn'>ADD BLOCK</div>
                    </div>


                    <div class = 'close-btn p-abs top-right p-1 flex-center' onclick = 'close_btn();'>
                        <i class = 'bi bi-x-lg'></i>
                    </div>

                    <div class = 'delete-btn p-abs top-left p-1 flex-center' onclick = 'close_btn();'>
                        <i class = 'bi bi-trash'></i>
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
    <script src = 'js/facility.js'></script>
    <script src = 'js/crud_facility.js'></script>
    <script src = 'js/crud_block.js'></script>
    <script src = 'js/crud_floor.js'></script>
    <script src = 'js/crud_room.js'></script>
    <script src = 'js/crud_plan.js'></script>
    <script src = 'js/search.js'></script>
</body>
</html>