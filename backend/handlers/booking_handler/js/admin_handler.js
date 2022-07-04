let booking_object = {
    id:                         '',
    user_name:                  '',
    user_email:                 '',
    facility_name:              '',
    facility_type:              '',
    facility_location:          '',
    facility_floor:             '',
    room_type:                  '',
    booking_id:                 '',
    amount_paid:                '',
    payment_verification:       '',
    booking_state:              '',
    booking_date:               '',
};

let entry_table = document.querySelector(".table");
entry_table.innerHTML = '';

let start_id = 0;
let start_date = '1800-01-01';
let today =  new Date();
let end_date = `${today.getFullYear()}-${today.getMonth() + 1}-${today.getDate()}`;

let php_url_base = '../backend/handlers/booking_handler/php/';

function fetch_bookings(start_id, limit) {
    
    $.ajax({
        method: 'POST',
        url: php_url_base + 'fetch_bookings.php',
        data: {start_id: start_id, limit: limit, start_date: start_date, end_date: end_date},
        success: (data) => {
            data.forEach( booking => {
                let table_entry = `
                    <div class = 'table-entry'>
                        <div class = 'te te-name'>${booking.user_name}</div>
                        <div class = 'te te-number'>${booking.user_number}</div>
                        <div class = 'te te-location'>${booking.facility_location}</div>
                        <div class = 'te te-date'>${booking.booking_date}</div>
                        <div class = 'te te-action'>
                            <div class = 'btn' onclick = 'edit_booking(${booking.booking_id});'>Edit</div>
                        </div>
                    </div>`;

                entry_table.innerHTML += table_entry;
            })
        }

    })
}

fetch_bookings(0, 10);

function select(target) {
    return document.querySelector(target);
}

display = {
    name: select('.fname'),
    type: select('.ftype'),
    location: select('.floc'),
    floor: select('.ffloor'),
    room: select('.froom'),
    booking_id: select('.bid'),
    booking_state: select('.bstate'),
    scheduled_date: select('.sdate'),
    user_name: select('.uname'),
    user_email: select('.uemail'),
    user_number: select('.unumber'),
    amount_paid: select('.uamount'),
}

function edit_booking(booking_id) {
    $.ajax({
        method: 'POST',
        url: php_url_base + 'fetch_booking.php',
        data: {booking_id: booking_id},
        success: (data) => {
            console.log(data);
            $.each(data,  (key, booking) => {
                booking_object = {
                    id:                           booking.id,
                    user_name:                    booking.user_name,
                    user_number:                  booking.user_number,
                    user_email:                   booking.user_email,
                    facility_name:                booking.facility_name,
                    facility_type:                booking.facility_type,
                    facility_location:            booking.facility_location,
                    facility_floor:               booking.facility_floor,
                    room_type:                    booking.room_type,
                    booking_id:                   booking.booking_id,
                    amount_paid:                  booking.amount_paid,
                    payment_verification:         booking.payment_verification,
                    booking_state:                booking.booking_state,
                    booking_date:                 booking.booking_date,
                };
            })

            display.name.innerHTML              = booking_object.facility_name;
            display.type.innerHTML              = booking_object.facility_type;
            display.location.innerHTML          = booking_object.facility_location;
            display.floor.innerHTML             = booking_object.facility_floor;
            display.room.innerHTML              = booking_object.room_type;
            display.booking_id.innerHTML        = booking_object.booking_id;
            display.booking_state.innerHTML     = booking_object.booking_state;
            display.scheduled_date.innerHTML    = booking_object.booking_date;
            display.user_name.innerHTML         = booking_object.user_name;
            display.user_email.innerHTML        = booking_object.user_email;
            display.user_number.innerHTML       = booking_object.user_number
            display.amount_paid.innerHTML       = booking_object.amount_paid;
            activate(".view-booking-details");
        }

    })
}

function approve_booking() {
    deactivate(".view-booking-details");
    if(booking_object.payment_verification == 'unverified') {
        verify_payment(booking_object.booking_id);
        location.href = 'verify.html?booking_id='+ booking_object.booking_id;
    }
}

function verify_payment(booking_id) {
    activate('.loader');
    $.ajax({
        method: 'POST',
        url: php_url_base + 'verify.php',
        data: {booking_id: booking_id},
        success: (data) => {
            deactivate('.loader');
            console.log(data);
            if(data != 'verified') {
                Swal.fire({
                    icon: 'error',
                    title: 'VERIFICATION ERROR',
                    text: 'Could not verify booking transaction',
                  })
            }
        }
    });
}

let search_id = 0;

function search_booking(query, book_id = 0, limit = 10, empty = true) {
    start_id = 0;

    if(query == '') 
    {
        entry_table.innerHTML = '';
        fetch_bookings(0, 20);
        document.querySelector('.show-more-btn .btn').remove();
        document.querySelector('.show-more-btn').innerHTML = `
            <div class = 'btn' onclick = 'show_more();'>Show More</div>
        `;
        return 0;
    }

    if(empty) entry_table.innerHTML = '';
    $.ajax({
        method: 'POST',
        url: php_url_base + 'search_booking.php',
        data: {search_query: clean_reverse(query), start_id: start_id, limit: limit, start_date: start_date, end_date: end_date},
        success: (data) => {
            console.log(data);
            //add response facilities to facility table
            data.forEach( value => {
                let table_entry = document.createElement('div');
                table_entry.setAttribute('class', 'table-entry');
                table_entry.setAttribute('onclick', 'select_table(this);')
                table_entry.innerHTML = `
                    <div class = 'te te-name'>${value['user_name']}</div>
                    <div class = 'te te-number'>${value['user_number']}</div>
                    <div class = 'te te-location'>${value['facility_location']}</div>
                    <div class = 'te te-date'>${value['booking_date']}</div>
                    <div class = 'te te-action'>
                        <div class = 'btn'>Edit</div>
                    </div>
                `;
                search_id = value['id'];

                let edit_btn = table_entry.querySelector('.te-action');
                
                edit_btn.innerHTML = `
                    <div class = 'btn' onclick = 'edit_booking(${value['booking_id']})'>Edit</div>
                `;

                

                entry_table.appendChild(table_entry);
                
            });
            document.querySelector('.show-more-btn .btn').remove();
            document.querySelector('.show-more-btn').innerHTML = `
                <div class = 'btn' onclick = 'search_booking("${clean(query)}", ${search_id}, 10, false);'>Show More</div>
            `;
            console.log(search_id);
        }
    })
}

function show_more() {
    fetch_bookings(start_id, 1);
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

function calender_bookings() {
    start_date = document.querySelector('.start-date').value;
    end_date = document.querySelector('.end-date').value;
    if(start_date != '' && end_date != '') {
        entry_table.innerHTML = '';
        fetch_bookings(0, 20);
    }
}