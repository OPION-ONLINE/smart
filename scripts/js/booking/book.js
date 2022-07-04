
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

                if(facility_blocks.indexOf(room['facility_block']) < 0 && room['room_count'] > 0)
                facility_blocks.push(room['facility_block']);

                if(!(room['facility_block'] in facility_floors)) 
                    facility_floors[room['facility_block']] = [];

                if(facility_floors[room['facility_block']].indexOf(room['floor_name']) < 0 && room['room_count'] > 0)
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
let selected_plan = '';
let selected_plan_two = '';
let plan = {
    // plan_info_one: plan_info_two,
}
let hotel_price = 0;

function book_process() {
    activate(".booking-modal");

    if(selected_gender.length > 0) {
        modal_position = 'plan';
        get_plan();
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

    
    if(facility_blocks.length > 1) {
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

function prev_btn() {

    if (modal_position == 'block') {
        selected_block = '';
        deactivate('.booking-modal');
        
    }
    else if( modal_position == 'floor') {
        selected_block = '';
        book_process();
    }
    else if( modal_position == 'room') {
        selected_floor = '';
        book_process();
    }
    else if( modal_position == 'gender') {
        selected_room = '';
        book_process();
    }
    else if( modal_position == 'plan' || modal_position == 'payment') {
        selected_gender = '';
        book_process();
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

            if(facility_type == 'hotel') {


                $.each(data, (key, plan) => {
                    if(plan.room_type == selected_room) {
                        console.log(plan);
                        hotel_price = plan.price;
                        let new_block = input_tab.replace('{{ tab-value }}', `Start Date`).replace('{{ tab-function }}', `selected_plan = \'${plan.plan_info_two}\'; check_date(); `).replace('{{ tab-name }}', 'start-date').replaceAll('{{ tab-class }}', '.start-date');
                        modal.innerHTML += new_block;
                        new_block = input_tab.replace('{{ tab-value }}', `End Date`).replace('{{ tab-function }}', `selected_plan = \'${plan.plan_info_two}\'; check_date(); `).replace('{{ tab-name }}', 'end-date').replaceAll('{{ tab-class }}', '.end-date');
                        modal.innerHTML += new_block;
                    }
                })
            }
            else {
                $.each(data, (key, plan) => {
                    let new_block = checkbox.replace('{{ tab-value }}', `${plan.plan_info_one}/GHC${plan.plan_info_two}`).replace(' {{ tab-function }}', `selected_plan = \'${plan.plan_info_two}\'; selected_plan_two = \'${plan.plan_info_one}\'; make_payment(); `);
                    modal.innerHTML += new_block;
                })
            }

            modal_position = 'payment';
        }
    });
}

function make_payment() {
    paystack();
    deactivate('.booking-modal');


}

function check_date() {
    let start_date = select('input[name = "start-date"]').value;
    let end_date = select('input[name = "end-date"]').value;
        if( start_date != '' && end_date != '') {
            make_payment();
        }
}

function paystack() {
    let price = parseInt(selected_plan) * 100;

    if(facility_type == 'hotel') {
        let start_date = select('input[name = "start-date"]').value;
        start_date = new Date(start_date);

        let end_date = select('input[name = "end-date"]').value;
        end_date = new Date(end_date);

        let interval = current_date.getTime() - start_date.getTime();
        interval = interval / (1000 * 60 * 60 * 24);

        if(interval > parseInt(selected_plan_two)) {
            Swal.fire({
                icon: 'info',
                title: 'LONG SHEDULE TIME',
                text: `Start date should not be longer than ${selected_plan_two} days`,
            })

            return false;
        }

        interval = start_date.getTime() - end_date.getTime();
        interval = interval / (1000 * 60 * 60 * 24);

        if(interval > parseInt(selected_plan)) {
            Swal.fire({
                icon: 'info',
                title: 'LONG SHEDULE TIME',
                text: `A customer can only stay for a maximum of ${selected_plan_two} days`,
            })
            return false;
        }

        price = parseInt(hotel_price) * 100;


    }
        

    let handler = PaystackPop.setup({

        key: 'pk_test_6d063cd3d7a2e36376c2c3766cefa8c9bdba645a', // Replace with your public key
    
        email: 'adedavid.tech@gmail.com',
    
        amount: price,
        currency: 'GHS',
    
        ref:  Math.floor((Math.random() * 1000000000) + 1), 
        
        // label: "Optional string that replaces customer email"
    
        onClose: function(){
    
        //   alert('Window closed.');
    
        },
    
        callback: function(response){
              
            $.ajax({
                method: 'POST',
                url: environment_link + 'conn/payment/verify.php',
                data: {
                    reference: response.reference,
                    username: username,
                    useremail: useremail,
                    usernumber: usernumber,
                    facility_name: facility_name,
                    facility_type: facility_type, 
                    facility_location: facility_location, 
                    selected_block: selected_block, 
                    selected_floor: selected_floor, 
                    selected_room: selected_room, 
                    selected_gender: selected_gender, 
                    selected_plan: selected_plan, 
                    amount_paid: parseInt(selected_plan)
                },
                success: (data) => {
                    console.log(data);
                }
    
            });
        },
    })

    handler.openIframe();

}

let start_id = 0;
let limit = 5;

function get_comment(start = '') {
    $.ajax({
        method: 'POST',
        url: environment_link + 'conn/booking_page/fetch_comments.php',
        data: {facility_name: facility_name, facility_type: facility_type, facility_location: facility_location, start_id: start_id, limit: limit},
        success: (data) => {

            let comment_box = select('.comments-container');
            selectAll('.comment.sub').forEach( comment => {
                comment.remove();
            })

            if(data == 'empty' && start != '') {
                Swal.fire({
                    icon: 'info',
                    title: 'THERE ARE NO COMMENTS',
                    text: 'Oops, no comments here 😁',
                })


                return false;
            }

            
        }
    })
}

get_comment();

function post_comment() {
    if(select('textarea').value.replaceAll(' ', '') == '') {
        Swal.fire({
            icon: 'error',
            title: 'NO COMMENT MADE',
            text: 'Oops, looks like you forgot to type your comment',
        });

        return false;
    }
    $.ajax({
        method: 'POST',
        url: environment_link + 'conn/booking_page/post_comments.php',
        data: {comment: select('textarea').value, username: username, usernumber: usernumber, facility_name: facility_name, facility_type: facility_type, facility_location: facility_location},
        success: (data) => {

            if(data == 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'THANK YOU',
                    text: ' Thank you, your feedback is most appreciated.😁',
                });

                return false;
            }
            else {
                Swal.fire({
                    icon: 'info',
                    title: 'SORRY',
                    text: 'You have\'nt stayed here that long to give a comment',
                });
                return false;
            }

           
        }
    })
}

