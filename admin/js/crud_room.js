
function open_rooms(floor) {
    selected.floor_name = floor;

    deactivateAll('.form');
    deactivateAll('.btns');
    activateAll('.preview');

    fetch_room();
    
}

function fetch_room() {

    $.ajax({
        method: 'POST',
        url: 'php/fetch_room.php',
        data: {
            facility_name:          selected.facility_name, 
            facility_type:          selected.facility_type, 
            facility_location:      selected.facility_location,
            facility_block:         selected.facility_block,
            floor_name:             selected.floor_name,
        },
        success: (data) => {
            console.log(data);
            if(data == 'empty') {
                selected.rooms = {};
                display_room();
                return false;
            }
            else {
                $.each(data, (key, room) => {
                    if( !(room.room_type in selected.rooms)) 
                        selected.rooms[room.room_type] = {
                            room_count:             room.room_count,
                            gender:                 room.gender,
                            outer_image:            room.outer_image,
                            room_image:             room.room_image,
                            lavatory_image:         room.lavatory_image,
                        };
                })
                display_room();
            }
                        
        },
    });
}

function display_room() {
    let rooms = Object.keys(selected.rooms);


    let preview_form = select('.form.preview');
    preview_form.innerHTML = '<h2>ROOMS\' LIST</h2>';

    deactivateAll('.form');
    deactivateAll('.btns');
    activateAll('.preview');

    if(rooms.length > 0) {

        rooms.forEach( room => {
            let preview_tab = tab;
    
            preview_tab.querySelector('.tab-value').innerHTML = room;
            preview_tab.querySelector('.action-btn:first-of-type').setAttribute('onclick', `edit_room("${room}")`);
            preview_tab.querySelector('.action-btn:last-of-type').setAttribute('onclick', `open_plans("${room}")`)
    
            preview_form.innerHTML += preview_tab.outerHTML;
    
        })
    }
    else {
        preview_form.classList.add('flex-col');
        preview_form.classList.add('flex-center');
        preview_form.setAttribute('style', 'display: flex !important;')
        preview_form.innerHTML = `<img src = 'images/empty.png' style = 'width: 100px; height: 100px; object-fit: cover;'> `
    }

    deactivate('.delete-btn');
    select('.delete-btn').setAttribute('onclick', ``);

    select('.preview.btns .btn').innerHTML = 'ADD ROOM';
    select('.preview.btns .btn').setAttribute('onclick', 'open_room()');

    activate('.container');
    tracker.position = 'floor';

}

function open_room() {
    select('.form.preview').setAttribute('style', '');
    deactivateAll('.form');
    deactivateAll('.btns');
    activateAll('.room');

    select('.room.btns .btn').setAttribute('onclick', 'add_room()');
    tracker.position = 'room';
}

function edit_room(room) {

    select('.form.preview').setAttribute('style', '');
    deactivateAll('.form');
    deactivateAll('.btns');
    activateAll('.room');

    select('input[name = "room_type"]').value = room;
    select('input[name = "room_count"]').value = selected.rooms[room].room_count;                 
    select('select[name = "gender"] option[selected]').innerHTML    = selected.rooms[room].gender;                 
    select('.outer_image').src =       path + 'image_server/' + selected.rooms[room].outer_image;
    select('.room_image').src  =       path + 'image_server/' + selected.rooms[room].room_image;
    select('.lavatory_image').src  =   path + 'image_server/' + selected.rooms[room].lavatory_image;

    select('.room.btns .btn').setAttribute('onclick', `update_room("${room}", "${selected.rooms[room].gender}")`);
    select('.room.btns .btn').innerHTML = 'UPDATE ROOM';
    select('.room h2').innerHTML = 'UPDATE ROOM';

    activate('.delete-btn');
    select('.delete-btn').setAttribute('onclick', `delete_room("${room}")`);

    tracker.position = 'room';
}

function add_room() {
    let room = select('input[name = "room_type"]').value.toUpperCase();
    let room_count = select('input[name = "room_count"]').value.toUpperCase();
    let gender = select('select[name = "gender"]').value.toUpperCase();
    let outer_image = select('.outer_image').src.replaceAll(path + 'image_server/', '');
    let room_image = select('.room_image').src.replaceAll(path + 'image_server/', '');
    let lavatory_image = select('.lavatory_image').src.replaceAll(path + 'image_server/', '');

    let empty = (
        room.replaceAll(' ', '').length <= 0                                      ||
        room_count.replaceAll(' ', '').length <= 0                                ||
        gender.replaceAll(' ', '').length <= 0                                    ||
        outer_image.replaceAll(' ', '').length == 'upload_image.jpg'              ||
        room_image.replaceAll(' ', '').length == 'upload_image.jpg'               ||
        lavatory_image.replaceAll(' ', '').length == 'upload_image.jpg'          
                   
    );

    if(!empty) {

        $.ajax({
            method: 'POST',
            url: 'php/add_room.php',
            data: {
                facility_name:          selected.facility_name, 
                facility_type:          selected.facility_type, 
                facility_location:      selected.facility_location,
                facility_block:         selected.facility_block,
                floor_name:             selected.floor_name,
                room_type:              room,
                room_count:             room_count,
                gender:                 gender,
                outer_image:            outer_image,
                room_image:             room_image,
                lavatory_image:         lavatory_image,

            },
            success: (data) => {
                console.log(data);
                if(data == 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'ROOM ADDED SUCCESSFULLY'
                    })

                    selected.rooms[room_type] = {
                        room_count:             room_count,
                        gender:                 gender,
                        outer_image:            outer_image,
                        room_image:             room_image,
                        lavatory_image:         lavatory_image,
                    };
                }
                else {
                    Swal.fire({
                        icon: 'info',
                        title: 'ROOM ALREADY EXISTS',
                        text: 'If you cant access block, please contact Opion tech support',
                    })
                }
                close_btn();
            }
        })
    }
    else {
        Swal.fire({
            icon: 'error',
            title: 'EMPTY INPUT',
            text: 'Please type in the block identification and try again',
        })
    }

}

function update_room(room, gender) {

    let new_room = select('input[name = "room_type"]').value.toUpperCase();
    let room_count = select('input[name = "room_count"]').value.toUpperCase();
    let new_gender = select('select[name = "gender"]').value.toUpperCase();
    let outer_image = select('.outer_image').src.replaceAll(path + 'image_server/', '');
    let room_image = select('.room_image').src.replaceAll(path + 'image_server/', '');
    let lavatory_image = select('.lavatory_image').src.replaceAll(path + 'image_server/', '');

    let empty = (
        room.replaceAll(' ', '').length <= 0                                      ||
        room_count.replaceAll(' ', '').length <= 0                                ||
        gender.replaceAll(' ', '').length <= 0                                    ||
        outer_image.replaceAll(' ', '').length == 'upload_image.jpg'              ||
        room_image.replaceAll(' ', '').length == 'upload_image.jpg'               ||
        lavatory_image.replaceAll(' ', '').length == 'upload_image.jpg'          
                   
    );
    if(!empty) {
        $.ajax({
            method: 'POST',
            url: 'php/update_room.php',
            data: {
                facility_name:          selected.facility_name, 
                facility_type:          selected.facility_type, 
                facility_location:      selected.facility_location,
                facility_block:         selected.facility_block,
                floor_name:             selected.floor_name,
                room_type:              new_room,
                old_room:               room,
                room_count:             room_count,
                old_gender:             gender,
                gender:                 new_gender,
                outer_image:            outer_image,
                room_image:             room_image,
                lavatory_image:         lavatory_image,

            },
            success: (data) => {
                console.log(data);
                if(data == 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'ROOM UPDATED SUCCESSFULLY'
                    }).then(() => {
                        close_btn();
                    })

                    selected.rooms[new_room] = selected.rooms[room];
                    delete selected.floors[room];
                    selected.roooms[new_room].gener = new_gender;
                }
                else {
                    Swal.fire({
                        icon: 'info',
                        title: 'ROOM ALREADY EXISTS',
                        text: 'If you cant access block, please contact Opion tech support',
                    })
                }
            }
        })
    }
    else {
        Swal.fire({
            icon: 'error',
            title: 'EMPTY INPUT',
            text: 'Please type in the block identification and try again',
        })
    }
}

function delete_floor(floor) {
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

          if(floor.replaceAll(' ', '').length > 0) {
            $.ajax({
                method: 'POST',
                url: 'php/delete_floor.php',
                data: {
                    facility_name:          selected.facility_name, 
                    facility_type:          selected.facility_type, 
                    facility_location:      selected.facility_location,
                    facility_block:         selected.facility_block,
                    old_floor:              floor,
    
                },
                success: (data) => {
                    console.log(data);
                    if(data == 'success'){
                        Swal.fire(
                            'Deleted!',
                            `${floor} has been deleted.`,
                            'success'
                        ).then(() => {
                            close_btn();
                        })
                        delete selected.floors[floor];
                    }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR DELETING FLOOR',
                            text: 'If you cant access block, please contact Opion tech support',
                        })
                    }
                }
            })
        }
        else {
            Swal.fire({
                icon: 'error',
                title: 'EMPTY INPUT',
                text: 'Please type in the block identification and try again',
            })
        }
        }
      })


}
