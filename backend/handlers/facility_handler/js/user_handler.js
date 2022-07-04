let facility_object = {};
fetch_facility("Shalom's International Hostel", "Hostel");
let facility_floors;             //an array of all floors in that facility;
let rooms; // an array of all rooms in that first floor;

let selected_floor = '';
let selected_room = '';

let floor_value = document.querySelector(".floor-type .choose-type-btn .btn span:first-of-type");
let room_value = document.querySelector(".room-type .choose-type-btn .btn span:first-of-type");

let floor_options = document.querySelector(".floor-type .options");
let room_options = document.querySelector(".room-type .options");

let image_box = [];
let image_box_count = 0;

let facility_location;


 function fetch_facility(facility_name, facility_type) { 

    $.ajax({
        method: 'POST',
        url: 'backend/handlers/facility_handler/php/fetch_facility.php', // make request to facility handler
        data: {facility_name: facility_name, facility_type}, //provide facility_name
        success: function(data) {
    
            document.querySelector("header .description").innerHTML = data[0].facility_description; //change facility description;
            document.querySelector("header .name").innerHTML = data[0].facility_name; //change facility description;
            facility_location = data[0].facility_location;
    
            //code to refformat data and store in facility_object
            $.ajax({
                method: 'POST',
                url: 'backend/handlers/facility_handler/php/fetch_floors.php', // make request to facility handler
                data: {facility_name: facility_name, facility_type: facility_type}, //provide facility_name
                success: function(data) {

                    $.each(data, (key, value) => {
                        //for each result check if the floor already exists
                        // if floor does not exist or floor exists and room_type does not exists
                        
                        if( !(value.floor_name in facility_object) ) {
                            facility_object[value.floor_name] = {}
                        }

                        if ( !(value.room_type in facility_object[value.floor_name]) ) { 
                            //create floor, and add room type or just add room type
                            facility_object[value.floor_name][value.room_type] = {
                                "price": value.price,
                                "images": JSON.parse(JSON.parse(value.room_images)),
                            };      
                        }
                    });

                    facility_floors = Object.keys(facility_object);             //an array of all floors in that facility;
                    rooms = Object.keys(facility_object[(facility_floors[0])]);
                    display_facility_dropdown();
                }
            })
        }
    
    })

    // return facility_object;
}


 function display_facility_dropdown() {
    //clear the floor&&room options for the floor&&room dropdown
    floor_options.innerHTML = '';
    room_options.innerHTML = '';
  
    floor_value.innerText = facility_floors[0]; //set the default value for the floor dropdown
    room_value.innerText = rooms[0];// set the default value for the room dropdown
    document.querySelector(".room-type .choose-type-btn .btn span:last-of-type").innerText = facility_object[facility_floors[0]][rooms[0]]["price"]
    
    floor_option('', facility_floors[0]);
    room_option('', rooms[0]);

    toggle_itm(".room-type .options"); //close the dropdown
    toggle_itm(".floor-type .options"); 

    //add floor options to the floor dropdown
    $.each(facility_floors, (key, value) => {
        floor_options.innerHTML += `
            <div class = 'option btn flex-row flex-around' onclick = 'floor_option(this, "${value}");'>
                <span>${value}</span>
                <span></span>
            </div>
        `;
    })

    //addd the room options available in the default floor to the room dropdown
    $.each(rooms, (key, value) => {
        console.log('loggin here');
        room_options.innerHTML += `
            <div class = 'option btn flex-row flex-around' onclick = 'room_option(this, "${value}")'>
                <span>${value}</span>
                <span>${facility_object[facility_floors[0]][value]["price"]}</span>
            </div>
        `;
    })

}

 function floor_option(item, value) {
    
    if(typeof(item) == 'object') setType(item, ".floor-type .choose-type-btn .btn"); //update the value for the floor dropdown
    toggle_itm(".floor-type .options"); //close the dropdown
    selected_floor = value; // store the selected floor value

    room_options.innerHTML = ''; // clear the room dropdown options
    let new_options = Object.keys(facility_object[value]); // get the list of rooms for the selected floor

    //update the room dropdown to include the list of rooms for the selected floor
    
    if(typeof(item) == 'object') {

        $.each(new_options, (key, value) => {
            room_options.innerHTML += `
                <div class = 'option btn flex-row flex-around' onclick = 'room_option(this, "${value}")'>
                    <span>${value}</span>
                    <span>${facility_object[selected_floor][value]["price"]}</span>
                </div>
            `;
        })
    }

}

 function room_option(item, value) {

    if(typeof(item) == 'object') setType(item, ".room-type .choose-type-btn .btn"); //update the value for the selected room
    toggle_itm(".room-type .options"); //close the dropdown
    selected_room = value; // store the selected room value

    //select the primary image containers
    let outer_views = document.querySelectorAll(".outer-view");
    let room_views = document.querySelectorAll(".room-view");
    let lavatory_views = document.querySelectorAll(".lavatory-view");

    document.querySelector('header img').src = facility_object[selected_floor][selected_room]["images"]["facility_image"];

    image_box = [
        facility_object[selected_floor][selected_room]["images"]["outer_view"],
        facility_object[selected_floor][selected_room]["images"]["facility_image"],
        facility_object[selected_floor][selected_room]["images"]["room_view"],
        facility_object[selected_floor][selected_room]["images"]["lavatory_view"]
    ];

    //update the primary image containers with the primary images for the selected room
    $.each(outer_views, (key, value) => {
        value.setAttribute('src', `${facility_object[selected_floor][selected_room]["images"]["outer_view"]}`)
    })

    $.each(room_views, (key, value) => {
        value.setAttribute('src', `${facility_object[selected_floor][selected_room]["images"]["room_view"]}`)
    })

    $.each(lavatory_views, (key, value) => {
        value.setAttribute('src', `${facility_object[selected_floor][selected_room]["images"]["lavatory_view"]}`)
    })

    //update gallery here

    facility_object[selected_floor][selected_room]["images"]["gallery"].forEach(url => {
        image_box.push(url);
    })
}  

let review_box = document.querySelector('.review-box');
review_box.innerHTML = '';

function get_comments(facility_name, facility_type) {
    $.ajax({
        method: 'POST',
        url: 'backend/handlers/facility_handler/php/fetch_comments.php', // make request to facility handler
        data: {facility_name: facility_name, facility_type}, //provide facility_name
        success: function(data) {
            console.log(data);

            data.forEach( comment => {
                review_box.innerHTML += `
                    <div class = 'review-item'>
                        <div class = 'top'>
                            <div class = 'name'>${comment['user_name']}</div>
                        </div>
                        <div class = 'bottom'>
                            <p class = 'review'>
                                ${comment['comment']}
                            </p>
                        </div>
                    </div>
                `
            })

            if(data.length > 0) {
                activate('.show-more-btn');
                activate('.description-box.recent-review');
            }
        }
    })
}

get_comments("Shalom's International Hostel", "Hostel");

function move_gallery(direction) {
    if(direction == 'left') {
        image_box_count == 0? image_box.length - 1 : --image_box_count;
        
    }
    else {
        image_box_count == image_box.length - 1? 0 : ++image_box_count;
    }

    document.querySelector('.image-box img').src = image_box[image_box_count];
}



const paymentForm = document.getElementById('paymentForm');

paymentForm.addEventListener("click", payWithPaystack, false);

function payWithPaystack() {

    user_email = 'adedavid.tech@gmail.com';
    user_name = 'David Shalom';
    user_number = '0552595712';

    $.ajax({
        method: 'POST',
        url: 'backend/handlers/facility_handler/php/check_booking.php', // make request to facility handler
        data: {username: user_name, useremail: user_email}, //provide facility_name
        success: function(data) {
            console.log(data);
            if (data == 'true') {
                //delete something
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You have already booked this hostel, there would be no refunds",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, book again!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //accept user input
                        Swal.fire({
                            title: 'Who are you booking For?',
                            input: 'text',
                            inputAttributes: {
                              autocapitalize: 'off'
                            },
                            showCancelButton: true,
                            confirmButtonText: 'Book Now',
                            showLoaderOnConfirm: true,
                            preConfirm: (login) => {
                              if(login == "" || login.length < 5) {
                                Swal.fire({
                                  icon: 'error',
                                  title: 'Name is to short',
                                  text: 'Please enter a full name (firstname and lastname)',
                                })
                                return false;
                              }
                              return true;
                            },
                            allowOutsideClick: () => !Swal.isLoading()
                          }).then((result) => {
                            if (result) {
                        
                              make_payment();
                            }
                          })
                    }
                })
            }
            else {
                make_payment();
            }
        }

    })





}

function make_payment() {
        $.ajax({
        method: 'POST',
        url: 'backend/handlers/facility_handler/php/fetch_facility.php', // make request to facility handler
        data: {facility_name: "Shalom's International Hostel", facility_type: "Hostel"}, //provide facility_name
        success: function(data) {
    
            //code to refformat data and store in facility_object
            $.ajax({
                method: 'POST',
                url: 'backend/handlers/facility_handler/php/fetch_floors.php', // make request to facility handler
                data: {facility_name: "Shalom's International Hostel", facility_type: "Hostel"}, //provide facility_name
                success: function(data) {

                    $.each(data, (key, value) => {
                        //for each result check if the floor already exists
                        // if floor does not exist or floor exists and room_type does not exists
                        
                        if( !(value.floor_name in facility_object) ) {
                            facility_object[value.floor_name] = {}
                        }

                        if ( !(value.room_type in facility_object[value.floor_name]) ) { 
                            //create floor, and add room type or just add room type
                            facility_object[value.floor_name][value.room_type] = {
                                "price": value.price,
                                "images": JSON.parse(JSON.parse(value.room_images)),
                            };      
                        }
                    });

                    facility_floors = Object.keys(facility_object);             //an array of all floors in that facility;
                    rooms = Object.keys(facility_object[(facility_floors[0])]);
                    
                    let handler = PaystackPop.setup({

                        key: 'pk_test_6d063cd3d7a2e36376c2c3766cefa8c9bdba645a', // Replace with your public key
                    
                        email: 'adedavid.tech@gmail.com',
                    
                        amount: parseInt(facility_object[selected_floor][selected_room]["price"]) * 100,
                    
                        currency: 'GHS',
                    
                        ref:  Math.floor((Math.random() * 1000000000) + 1), 
                        
                        // label: "Optional string that replaces customer email"
                    
                        onClose: function(){
                    
                          alert('Window closed.');
                    
                        },
                    
                        callback: function(response){
                              
                            // console.log('before request', response);
                            
                            activate('.loader');
                            $.ajax({
                                
                          
                              url: `https://localhost/me/Opion_ehostel/backend/handlers/facility_handler/php/verify_transaction.php?reference=${response.reference}&user_email=${user_email}&user_name=${user_name}&user_number=${user_number}&facility_name=${"Shalom's International Hostel"}&facility_type=${"Hostel"}&facility_location=${facility_location}&facility_floor=${selected_floor}&room_type=${selected_room}&amount_paid=${facility_object[selected_floor][selected_room]["price"]}`,
                          
                              method: 'get',
                          
                              success: function (data) {
                                deactivate('.loader');
                                  // the transaction status is in response.data.status
                                console.log(data);
                                console.log(`https://localhost/me/Opion_ehostel/backend/handlers/facility_handler/php/verify_transaction.php?reference=${response.reference}&user_email=${user_email}&user_name=${user_name}&user_number=${user_number}&facility_name=${"Shalom's International Hostel"}&facility_type=${"Hostel"}&facility_location=${facility_location}&facility_floor=${selected_floor}&room_type=${selected_room}&amount_paid=${facility_object[selected_floor][selected_room]["price"]}`);

                                
                                if(data == 'payment made') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Booking Successfull',
                                    })
                                    activate('.loader');
                                    setTimeout( () => {
                                        sessionStorage.setItem('booking_id', response.reference);
                                        sessionStorage.setItem('username', user_name);
                                        location.href = 'instructions.html';
                                    }, 3000)
                                }
                                else if (data == 'payment not made') {
                                    Swal.fire({
                                        icon:  'error',
                                        title: 'Payment Not Made',
                                        text:  'Please click the "Book Now" button and try again',
                                    })
                                }
                          
                              }
                          
                            });
                          
                          }
                    
                      });
                    
                      handler.openIframe();
                    
                }
            })
        }
    
    })
}

