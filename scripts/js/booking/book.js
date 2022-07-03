
let rooms = {
    'roomid': {
                facility_block:         '',
                floor_name:             '',
                room_type:              '',
                gender:                 '',
                outer_image:            '',
                room_image:             '',
                lavatory_image:         '',
                room_count:             '',
                room_price:             '',
            }
};

let room_count = 0;

let display_images = {
    'room_type' : ['array of images'],
}

let facility_blocks = [];
let facility_floors = {
    // 'block': ['floors'],
};

let room_gender = [];

let image_path = 'images/'

let display_pos;
let room_type;
let room_type_size;

let checkbox = select('.tab.radio-box').outerHTML;
let tab = select('.tab.normal').outerHTML;
let input_tab = select('.tab.input').outerHTML;

let modal = select('.choice-box');
modal.innerHTML = '';



function display_rooms() {

    $.ajax({
        method: 'POST',
        url: environment_link + 'conn/booking_page/fetch_rooms.php',
        data: {facility_name: facility_name, facility_type: facility_type, facility_location: facility_location},
        success: (data) => {

            if(data == 'empty') {
                Swal.fire({
                    icon: 'info',
                    title: 'ROOMS UNAVAILABLE',
                    text: 'Oops, rooms are currently unavailable please check back later',
                }).then((result) => {
                    history.back();
                  })


                return false;
            }

            $.each(data, (key, room) => {

                rooms[`room${room['id']}`] = {
                    facility_block:         room['facility_block'],
                    floor_name:             room['floor_name'],
                    room_type:              room['room_type'],
                    gender:                 room['gender'],
                    outer_image:            room['outer_image'],
                    room_image:             room['room_image'],
                    lavatory_image:         room['lavatory_image'],
                    room_count:             room['room_count'],
                    room_price:             room['room_price'],
                }

                if( !(room['room_type'] in display_images) )  
                display_images[room['room_type']] = [];
                display_images[room['room_type']].push(room['outer_image']);
                display_images[room['room_type']].push(room['room_image']);
                display_images[room['room_type']].push(room['lavatory_image']);

                if(facility_blocks.indexOf(room['facility_block']) < 0 )//&& room['room_count'] > 0)
                facility_blocks.push(room['facility_block']);

                if(!(room['facility_block'] in facility_floors)) 
                    facility_floors[room['facility_block']] = [];

                if(facility_floors[room['facility_block']].indexOf(room['floor_name']) < 0 )//&& room['room_count'] > 0)
                    facility_floors[room['facility_block']].push(room['floor_name']);
                

                if(room['room_count'] > 0) {
                    room_count++;
                }
                
            });

            display_pos = 0;
            room_type = Object.keys(display_images);
            room_type_size = room_type.length;

            display_next();
        }
    })
}

display_rooms();

function display_next(direction = 'right') {

    if ( direction == 'right' && display_pos < room_type_size - 1) display_pos++;
    if ( direction == 'left' && display_pos > 1) display_pos--;
    if ( display_pos < 1) display_pos = 1;

    selectAll('.facility-image').forEach( image_box => {
        image_box.src = image_path + display_images[room_type[display_pos]][0];
        console.log('did it')
    })

    select('.room-type-name').innerText = Object.keys(display_images)[display_pos];
}

let modal_position = '';
let selected_block = '';
let selected_floor = '';
let selected_room = '';
let selected_gender = '';
let plan = {
    // plan_info_one: plan_info_two,
}

function book_process() {
    activate(".booking-modal");

    if(selected_gender.length > 0) {
        get_plan();
        modal_position = 'block';
        return true;
    }

    if(selected_room.length > 0) {
        modal.innerHTML = '<h2>Choose Your Gender</h2>';

        $.each(rooms, (key, room) => {
            if(room.facility_block == selected_block && room.floor_name == selected_floor && room.room_type == selected_room && room.gender == 'Male') {
                let new_block = checkbox.replace('{{ tab-value }}', room.gender).replace(' {{ tab-function }}', `selected_gender = \'${room.gender}\'; book_process(); `);
                modal.innerHTML += new_block;
                return true;
            }
        })

        $.each(rooms, (key, room) => {
            if(room.facility_block == selected_block && room.floor_name == selected_floor && room.room_type == selected_room && room.gender == 'Female') {
                let new_block = checkbox.replace('{{ tab-value }}', room.gender).replace(' {{ tab-function }}', `selected_gender = \'${room.gender}\'; book_process(); `);
                modal.innerHTML += new_block;
                return true;
            }
        })

        modal_position = 'gender';
        return false;
    }

    if(selected_floor.length > 0) {
        modal.innerHTML = '<h2>Choose A Room</h2>';

        $.each(rooms, (key, room) => {
            if(room.facility_block == selected_block && room.floor_name == selected_floor) {
                let new_block = checkbox.replace('{{ tab-value }}', room.room_type).replace(' {{ tab-function }}', `selected_room = \'${room.room_type}\'; book_process(); `);
                modal.innerHTML += new_block;
            }
        })
        modal_position = 'room';
        return false;
    }

    if(selected_block.length > 0) {
        modal.innerHTML = '<h2>Choose A Floor</h2>';
        if(typeof(facility_floors[selected_block]) != undefined) {
            $.each(facility_floors, (key, floors) => {
                floors.forEach( floor => {
                    let new_block = checkbox.replace('{{ tab-value }}', floor).replace(' {{ tab-function }}', `selected_floor = \'${floor}\'; book_process(); `);
                    modal.innerHTML += new_block;
                })
                
            });

            modal_position = 'floor';
            return false;
        }
    }

    
    if(facility_blocks.length > -1) {
        modal.innerHTML = '<h2>Choose A Block</h2>'
        facility_blocks.forEach( block => {
            let new_block = checkbox.replace('{{ tab-value }}', block).replace(' {{ tab-function }}', `selected_block = \'${block}\'; book_process();`);
            modal.innerHTML += new_block;
        })
        modal_position = 'block';
        return false;
    }
    if(facility_blocks.length == 0) {
        modal.innerHTML = 
        ` <div class = 'p-abs top-left full-hw flex-center'>
            <img class = 'obj-fit' style = 'height: 150px; width: 150px;' src = 'images/room_unavailable.webp'>
        </div>`;

        return false;
    }
    else {
        selected_block = facility_blocks[0];
        modal_position = 'block';
        book_process();
        return false;
    }
    
}


function get_plan() {
    $.ajax({
        method: 'POST',
        url: environment_link + 'conn/booking_page/fetch_plan.php',
        data: {facility_name: facility_name, facility_type: facility_type, facility_location: facility_location, selected_block: selected_block, selected_floor: selected_floor, selected_room: selected_room, selected_gender: selected_gender},
        success: (data) => {
            console.log(data);

            modal.innerHTML = '<h2>Choose A Plan</h2>';

            if(data == 'empty') {
                modal.innerHTML = 
                ` <div class = 'p-abs top-left full-hw flex-center'>
                    <img class = 'obj-fit' style = 'height: 150px; width: 150px;' src = 'images/room_unavailable.webp'>
                </div>`;
                return false;
            }

            $.each(data, (key, plan) => {
              
                let new_block = checkbox.replace('{{ tab-value }}', `${plan.plan_info_one}/GHC${plan.plan_info_two}`).replace(' {{ tab-function }}', `selected_plan = \'${plan.plan_info_one}\'; make_payment(); `);
                modal.innerHTML += new_block;
                
            })
        }
    });
}