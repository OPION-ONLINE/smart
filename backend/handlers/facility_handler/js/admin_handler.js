
let entry_table = document.querySelector('.table'); // select facility table
entry_table.innerHTML = ''; //clear table
let selected_floor = '';
let selected_room = '';
let selected_table = '';
let default_image_path = 'https://localhost/me/Opion_ehostel/admin/images/image-upload.gif';

//object to store facility data to send to db
let add_object = {
    facility_name:        '',
    facility_type:        '',
    facility_contact:     '',
    facility_description: '',
    facility_location:    '',
    location_coordinates: '',
    facility_state:       '',

    facility_floors: {
        // 'floor_name': {
        //     'room_type': {
        //         'room_images': 'images json',
        //         'price': 'room price here',
        //         'number_of_rooms': '',
        //     }
        // }
    }
};

function fetch_room(floor_name, room_type) {

    let room_images = JSON.parse(add_object.facility_floors[floor_name][room_type]['room_images']);
    let parent = document.querySelector(".add-image-box .box");
    let gallery = document.querySelectorAll('.image_gallery');
    let gallery_size = gallery.length;
    let count = 0;

    //set input values to details of room specified
    setvalue('input[name = "floor_name"]'  , floor_name);
    setvalue('input[name = "room_type"]'   , room_type);
    setvalue('input[name = "room_price"]'  , add_object.facility_floors[floor_name][room_type]['price']);
    setvalue('input[name = "num_of_rooms"]', add_object.facility_floors[floor_name][room_type]['number_of_rooms']);
    setvalue('.room_view'    , room_images['room_view'], 'src');
    setvalue('.outer_view'   , room_images['outer_view'], 'src');
    setvalue('.lavatory_view', room_images['lavatory_view'], 'src');
    setvalue('.facility_image', room_images['facility_image'], 'src');

    room_images['gallery'].forEach( url => {
        
        if(count < gallery_size) {
            gallery[count].src = url;
            count++;
        }
        else {
            parent.innerHTML += `
                <div class = 'p-rel' onclick = 'add_image_to_gallery(this);'>
                    <img src = '${url}' class = 'obj-fit p-rel z-1 image_gallery'>
                    <div class = 'click-img p-abs bottom-left full-w flex-center z-2'>
                        Image Gallery
                    </div>
                </div>`; // adding three boxes here
        }
    })

    activate(".modal-sub-modal");
    toggle_class(".add-image-box", "active", "deactive");

    selected_floor = floor_name;
    selected_room = room_type;
}

function fetch_floors() {
    let parent = document.querySelector('.modal-content');
    let children;

    if(children = parent.querySelectorAll('.fetch-room')) {
        [...children].forEach( child => {
            child.remove();
        })
    }

    $.each( add_object.facility_floors, (key, value) => {

        $.each(value, (sub_key, sub_value) => {

            parent.insertAdjacentHTML( 'beforeend', `
                <div class = 'modal-entry fetch-room'>
                    <div class = 'modal-input modal-value' onclick = 'fetch_room("${key}", "${sub_key}");'>
                        <span>${key} / ${sub_key}</span>
                    </div>
                </div>
            `);

        });

    });
}
//validity of inputs from add floor modal
let floor_form_state = true;
let facility_id = 0;
let search_id = 0;
let start_date = '1800-01-01';
let today =  new Date();
let end_date = `${today.getFullYear()}-${today.getMonth() + 1}-${today.getDate()}`;

function calender_facilities() {
    start_date = document.querySelector('.start-date').value;
    end_date = document.querySelector('.end-date').value;
    if(start_date != '' && end_date != '') {
        entry_table.innerHTML = '';
        fetch_facilities(0, 20);
    }
}

function search_facilities(search_query, start_id = 0, limit = 10, empty = true) {
    facility_id = 0;

    if(search_query == '') 
    {
        entry_table.innerHTML = '';
        fetch_facilities(0, 20);
        document.querySelector('.show-more-btn .btn').remove();
        document.querySelector('.show-more-btn').innerHTML = `
            <div class = 'btn' onclick = 'show_more();'>Show More</div>
        `;
        return 0;
    }

    if(empty) entry_table.innerHTML = '';
    $.ajax({
        method: 'POST',
        url: '../backend/handlers/facility_handler/php/search_facilities.php', // make request to facility handler
        data: {search_query: clean_reverse(search_query), start_id: start_id, limit: limit, start_date: start_date, end_date: end_date}, //provide facility_name and limit(number of facilities to return)
        success: function(data) {
            
            //add response facilities to facility table
            data.forEach( value => {
                let table_entry = document.createElement('div');
                table_entry.setAttribute('class', 'table-entry');
                table_entry.setAttribute('onclick', 'select_table(this);')
                table_entry.innerHTML = `
                    <div class = 'te te-name'>${value['facility_name']}</div>
                    <div class = 'te te-number'>${value['facility_contact']}</div>
                    <div class = 'te te-location'>${value['facility_location']}</div>
                    <div class = 'te te-date'>${value['facility_date']}</div>
                    <div class = 'te te-action'>
                        <div class = 'btn'>Edit</div>
                    </div>
                `;
                search_id = value['id'];

                let edit_btn = table_entry.querySelector('.te-action');
                let name = clean(value['facility_name']);
                let type = clean(value['facility_type']);
                edit_btn.innerHTML = `
                    <div class = 'btn' onclick = "edit_btn_function(\`${name}\`, \`${type}\`)">Edit</div>
                `;

                

                entry_table.appendChild(table_entry);
                
            });
            document.querySelector('.show-more-btn .btn').remove();
            document.querySelector('.show-more-btn').innerHTML = `
                <div class = 'btn' onclick = 'search_facilities("${clean(search_query)}", ${search_id}, 10, false);'>Show More</div>
            `;
            console.log(search_id);
        }
    
    })
}

function fetch_facilities(start_id, limit ) {
    $.ajax({
        method: 'POST',
        url: '../backend/handlers/facility_handler/php/fetch_facilities.php', // make request to facility handler
        data: {start_id: start_id, limit: limit, start_date: start_date, end_date: end_date}, //provide facility_name and limit(number of facilities to return)
        success: function(data) {
            
            //add response facilities to facility table
            data.forEach( value => {
                let table_entry = document.createElement('div');
                table_entry.setAttribute('class', 'table-entry');
                table_entry.setAttribute('onclick', 'select_table(this);')
                table_entry.innerHTML = `
                    <div class = 'te te-name'>${value['facility_name']}</div>
                    <div class = 'te te-number'>${value['facility_contact']}</div>
                    <div class = 'te te-location'>${value['facility_location']}</div>
                    <div class = 'te te-date'>${value['facility_date']}</div>
                    <div class = 'te te-action'>
                        <div class = 'btn'>Edit</div>
                    </div>
                `;
                facility_id = value['id'];

                let edit_btn = table_entry.querySelector('.te-action');
                let name = clean(value['facility_name']);
                let type = clean(value['facility_type']);
                edit_btn.innerHTML = `
                    <div class = 'btn' onclick = "edit_btn_function(\`${name}\`, \`${type}\`)">Edit</div>
                `;

                entry_table.appendChild(table_entry);
                
            });
            console.log(facility_id);
        }
    
    })
}

fetch_facilities(0, 1);

function show_more() {
    fetch_facilities(facility_id, 1);
}

function add_floor() {
    floor_form_state  = true;
    let floor_name    = getvalue('input[name = "floor_name"]', "Floor Name");
    let room_type     = getvalue('input[name = "room_type"]', "Room Type");
    let room_price    = getvalue('input[name = "room_price"]', "Room Price");
    let num_of_rooms  = getvalue('input[name = "num_of_rooms"]', "Number of Rooms");
    let image_gallery = [];
    

    //select all gallery images
    [...(document.querySelectorAll('.image_gallery'))].forEach( image_item => {
        if (image_item.src != default_image_path)
        image_gallery.push(image_item.src);
    })


    //compare images with default_image_path and add new images to room images

    let room_images = {
        'facility_image': (document.querySelector('.facility_image').src == default_image_path? '' : document.querySelector('.facility_image').src),
        'room_view': (document.querySelector('.room_view').src == default_image_path? '' : document.querySelector('.room_view').src),
        'outer_view': (document.querySelector('.outer_view').src == default_image_path? '' : document.querySelector('.outer_view').src),
        'lavatory_view': (document.querySelector('.lavatory_view').src == default_image_path? '' : document.querySelector('.lavatory_view').src),
        'gallery': image_gallery,
    }

    //check if form inputs are valid
    if ( 
        room_images['facility_image']     == '' || 
        room_images['room_view']          == '' || 
        room_images['outer_view']         == '' || 
        room_images['lavatory_view']      == '' ||
        !floor_form_state
    ) {
        promptme("Room Information not complete (input and images)", 'empty', ".add-image-box");
        floor_form_state = false; //declares form inputs as invalid
    }

    //add valid inputs to add facility object
    if (floor_form_state) {

        if(add_object.facility_floors[selected_floor]) {
            delete add_object.facility_floors[selected_floor]; //clear the existing floor;  
        } 

        //insert data to new floor;
        add_object.facility_floors[floor_name] = {};
        add_object.facility_floors[floor_name][room_type] = {};
        add_object.facility_floors[floor_name][room_type]['room_images'] = JSON.stringify(room_images);
        add_object.facility_floors[floor_name][room_type]['price'] = room_price;
        add_object.facility_floors[floor_name][room_type]['number_of_rooms'] = num_of_rooms;
    

        // document.querySelector('.modal-content').innerHTML += `
        //     <div class = 'modal-entry'>
        //         <div class = 'modal-input modal-value'>
        //             <span>${floor_name} / ${room_type}</span>
        //         </div>
        //     </div>
        // `;

        close_floor();
    }
 
}

function close_floor() {
    fetch_floors();
    clearfloor();
    deactivate(".add-image-box", "deactive");
    deactivate(".add-image-box","active");
    deactivate(".modal-sub-modal");
    selected_floor = '';
    selected_room  = '';
}

//empty floor-modal inputs and images  
function clearfloor() {
    //clean floor modal inputs
    setvalue('.modal-sub-modal input');

    let parent = document.querySelector(".add-image-box .box");
    parent.innerHTML = ''; //cleaning images here

    let image_txt = ['Facility Image', 'Room View', 'Outer View', 'Lavatory View', 'Image Galler'];
    let count = 0;

    ['facility_image', 'room_view', 'outer_view', 'lavatory_view', 'image_gallery'].forEach( image_class => {
        parent.innerHTML += `
            <div class = 'p-rel' onclick = '${count < 3? 'activate(".image_server"); set_target(this);' : 'add_image_to_gallery(this)'}'>
                <img src = '${default_image_path}' class = 'obj-fit p-rel z-1 ${image_class}'>
                <div class = 'click-img p-abs bottom-left full-w flex-center z-2'>
                    ${image_txt[count]}
                </div>
            </div>`; // adding three boxes here
            count++;
    })

}

//get value from input elements
function getvalue(target, target_name, type = 'value', compulsary = true) {

    document.querySelector(target).style.border = '1px dashed #999'; //reset color

    let target_value;
    if (type == 'value') 
    {
        target_value = document.querySelector(target).value;
    }
    else if (type == 'src') {
        target_value = document.querySelector(target).src;
    }
    else {
        target_value = document.querySelector(target).innerHTML;
    }

    if(compulsary && target_value == '') {
        
        // promptme(target_name, 'empty', target);
        document.querySelector(target).style.border = '1px solid red';
        floor_form_state = false;
        
    }
    

    return target_value;
}

//setvalue of input element
function setvalue(targets, value = '', type = 'input') {
    targets = document.querySelectorAll(targets);

    if(type == 'input') {
        [...targets].forEach( target => {target.value = value} );
    }

    if (type == 'src') {
        [...targets].forEach( target => {target.src = value} );
    }

    if (type == 'elem') {
        [...targets].forEach( target => {target.innerHTML = value} );
    }

}

//prompt alert function
function promptme(target_name, state, target) {
      //error message
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: `${target_name} ${state}`,
    })
    document.querySelector(target).style.border = '1px solid red';
}

function add_image_to_gallery(me) {
    activate(".image_server");
    set_target(me);

    let checkme = () => {
        let src = me.querySelector('img').src;
        if(src != default_image_path) {
            
            let parent = document.querySelector(".add-image-box .box");
            parent.innerHTML += `
                <div class = 'p-rel' onclick = 'add_image_to_gallery(this);'>
                    <img src = 'images/image-upload.gif' class = 'obj-fit p-rel z-1 image_gallery'>
                    <div class = 'click-img p-abs bottom-left full-w flex-center z-2'>
                    Image Gallery
                    </div>
                </div>`;

            console.log("found");
            return true;
        }
        console.log('not found');
        setTimeout(checkme, 100);
    }

    checkme();
}

function add_new_facility_btn() {
    add_object = {
        facility_name:        '',
        facility_type:        '',
        facility_contact:     '',
        facility_description: '',
        facility_location:    '',
        location_coordinates: '',
        facility_state:       '',
    
        facility_floors: {}
    };
    modal_add_mode();
    activate(".facility-modal-case");
    setvalue('.facility-modal-case input');
    setvalue('.facility-modal-case textarea');
    fetch_floors();
}

function add_facility() {
    
    if(check()) {
        $.ajax({
            method: 'POST',
            url: '../backend/handlers/facility_handler/php/add_facility.php', // make request to facility handler
            data: {facility: JSON.stringify(add_object)}, //provide facility_name
            success: function(data) {

                console.log(data);

                clearfloor();
                setvalue('.facility-modal input');
                setvalue('.facility-modal textarea');
                deactivate(".facility-modal-case");

                let rooms = document.querySelectorAll(".fetch-room");

                [...rooms].forEach( room => {
                    room.remove();
                })

                selected_floor = '';
                selected_room  = '';

                let table_entry = document.createElement('div');
                table_entry.setAttribute('class', 'table-entry');
                table_entry.setAttribute('onclick', 'select_table(this);')
                table_entry.innerHTML = `
                    <div class = 'te te-name'>      ${add_object.facility_name}     </div>
                    <div class = 'te te-number'>    ${add_object.facility_contact}  </div>
                    <div class = 'te te-location'>  ${add_object.facility_location} </div>
                    <div class = 'te te-date'>      ${add_object.facility_state}    </div>
                    <div class = 'te te-action'>
                        <div class = 'btn'>Edit</div>
                    </div>
                `

                let edit_btn = table_entry.querySelector('.te-action');
                let name = clean(add_object.facility_name);
                console.log(name);
                let type = clean(add_object.facility_type);
                edit_btn.innerHTML = `
                    <div class = 'btn' onclick = "edit_btn_function(\`${name}\`, \`${type}\`)">Edit</div>
                `;
               

                entry_table.appendChild(table_entry);
                // success code here;
                // add_object = {
                //     facility_name:        '',
                //     facility_type:        '',
                //     facility_contact:     '',
                //     facility_description: '',
                //     facility_location:    '',
                //     location_coordinates: '',
                //     facility_state:       '',
                //     facility_image:       '',
                
                //     facility_floors: {}
                // };
            }
        
        })

    }
}

function edit_btn_function(name, type) {
    edit_facility(name, type);
    console.log('name: ', name, add_object.facility_name, 'type: ', type);
}

function update_facility(facility_name, facility_type) {
    if(!check()) return false;
    activate('.loader');
    $.ajax({
        method: 'POST',
        url: '../backend/handlers/facility_handler/php/update_facility.php',
        data: {facility_name: clean_reverse(facility_name), facility_type: clean_reverse(facility_type), facility: JSON.stringify(add_object)},
        success: function(data) {
            selected_table.querySelector('.te-name').innerText = add_object.facility_name;
            selected_table.querySelector('.te-number').innerText = add_object.facility_contact;
            selected_table.querySelector('.te-location').innerText = add_object.facility_location;
            console.log(data);
            deactivate('.facility-modal-case');
            deactivate('.loader');
        }
    })
}

function clean(value) {
    value = value.replace('\'', '&#39;');
    value = value.replace('"', '&#34;');
    return value;
}

function clean_reverse(value) {
    value = value.replace('&#39;', '\'');
    value = value.replace('&#34;', '"');
    return value;
}

function check() {
    floor_form_state            = true;
    let facility_name           = getvalue('input[name = "facility_name"]', "Facility Name");
    let facility_type           = getvalue('.facility_type .dropdown-value span', "Facility Type", 'elem');
    let facility_contact        = getvalue('input[name = "facility_contact"]', "Facility Contact");
    let facility_description    = getvalue('textarea[name = "facility_description"]', "Facility Description");
    let facility_state          = getvalue('.facility_state .dropdown-value span', "Facility State", 'elem');
    let facility_location       = getvalue('input[name = "facility_location"]', "Facility Location");
    let room_size               = document.querySelectorAll('.fetch-room').length;

    if( room_size <= 0) {
        floor_form_state = false;
    }

    if(floor_form_state) {
        add_object.facility_name        = facility_name;
        add_object.facility_type        = facility_type;
        add_object.facility_contact     = facility_contact;
        add_object.facility_description = facility_description;
        add_object.facility_state       = facility_state;
        add_object.facility_location    = facility_location;
        // add_object.location_coordinates;
    }
    return floor_form_state;
}

function edit_facility(facility_name, facility_type) {
    console.log(facility_name, facility_type);
    activate(".facility-modal-case");
    activate('.loader');
    fetch_facility(facility_name, facility_type);
    modal_edit_mode(facility_name, facility_type);
    deactivate('.loader');

}

function modal_edit_mode(facility_name, facility_type) {
    document.querySelector('.remove_facility_btn').remove();
    document.querySelector('.add_facility_btn').remove();
    document.querySelector('.add_facility_modal_bottom').innerHTML += 
     `
     <div class = 'btn flex-center remove_facility_btn' onclick = 'delete_facility("${clean(facility_name)}", "${clean(facility_type)}");'>REMOVE FACILITY</div>
     <div class = 'btn flex-center add_facility_btn' onclick = 'update_facility("${clean(facility_name)}", "${clean(facility_type)}");'>UPDATE FACILITY</div>`
}

function modal_add_mode() {
    document.querySelector('.remove_facility_btn').remove();
    document.querySelector('.add_facility_btn').remove();
    document.querySelector('.add_facility_modal_bottom').innerHTML += 
     `
     <div class = 'btn flex-center remove_facility_btn' onclick = '
     clearfloor();
     setvalue(".facility-modal input");
     setvalue(".facility-modal textarea");
     deactivate(".facility-modal-case"); '>REMOVE FACILITY</div>
     <div class = 'btn flex-center add_facility_btn' onclick = 'add_facility();'>ADD FACILITY</div>`
}

function fetch_facility(facility_name, facility_type) {
    $.ajax({
        method: 'POST',
        url: '../backend/handlers/facility_handler/php/fetch_facility.php',
        data: {facility_name: clean_reverse(facility_name), facility_type: clean_reverse(facility_type)},
        success: function (data) {
            console.log(data, facility_name, facility_type);
            

            add_object = {
                facility_name:        data[0].facility_name,
                facility_type:        data[0].facility_type,
                facility_contact:     data[0].facility_contact,
                facility_description: data[0].facility_description,
                facility_location:    data[0].facility_location,
                location_coordinates: data[0].location_coordinates,
                facility_state:       data[0].facility_state,
            
                facility_floors: get_floors(facility_name, facility_type)
            };
            
        }
    })
}

function get_floors(facility_name, facility_type) {
    let facility_floors = {};

    $.ajax({
        method: 'POST',
        url: '../backend/handlers/facility_handler/php/fetch_floors.php',
        data: {facility_name: clean_reverse(facility_name), facility_type: clean_reverse(facility_type)},
        success: function (data) {

            console.log(data, facility_name, facility_type);

            $.each(data, (key, value) => {

                facility_floors[value.floor_name] = {}
                facility_floors[value.floor_name][value.room_type] = {
                    'room_images': JSON.parse(value.room_images),
                    'price': value.price,
                    'number_of_rooms': value.number_of_rooms
                }

            })

            setvalue('.facility_image', add_object.facility_image);
            setvalue('input[name = "facility_name"]', add_object.facility_name);
            setvalue('.facility_type .dropdown-value span', add_object.facility_type, 'elem');
            setvalue('input[name = "facility_contact"]', add_object.facility_contact);
            setvalue('textarea[name = "facility_description"]', add_object.facility_description);
            setvalue('.facility_state .dropdown-value span', add_object.facility_state, 'elem');
            setvalue('input[name = "facility_location"]', add_object.facility_location);            
            fetch_floors();

        }
    })
    
    return facility_floors;
}

function select_table(me) {
    selected_table = me;
}

function delete_facility(facility_name, facility_type) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            activate('.loader');
            $.ajax({
                method: 'POST',
                url: '../backend/handlers/facility_handler/php/delete_facility.php',
                data: {facility_name: clean_reverse(facility_name), facility_type: clean_reverse(facility_type)},
                success: (data) => {
                    console.log(data);
                    clearfloor();
                    setvalue('.facility-modal input');
                    setvalue('.facility-modal textarea');
                    deactivate(".facility-modal-case");
                    selected_table.remove();

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                    deactivate('.loader');
                }
            })
          
        }
      })
    
}

function remove_room() {
    delete add_object.facility_floors[selected_floor][selected_room];
    close_floor();
}

setvalue('.facility-modal input');
setvalue('.facility-modal textarea');