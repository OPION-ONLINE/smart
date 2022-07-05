
function open_floors(block) {
    selected.facility_block = block;

    deactivateAll('.form');
    deactivateAll('.btns');
    activateAll('.preview');

    fetch_floor();
    
}

function fetch_floor() {

    $.ajax({
        method: 'POST',
        url: 'php/fetch_floor.php',
        data: {
            facility_name:          selected.facility_name, 
            facility_type:          selected.facility_type, 
            facility_location:      selected.facility_location,
            facility_block:         selected.facility_block,
        },
        success: (data) => {
            console.log(data);
            if(data == 'empty') {
                selected.floors = {};
                display_floor();
                return false;
            }
            else {
                $.each(data, (key, floor) => {
                    if( !(floor.floor_name in selected.floors)) 
                        selected.floors[floor.floor_name] = {};
                })
                display_floor();
            }
                        
        },
    });
}

function display_floor() {
    let floors = Object.keys(selected.floors);


    let preview_form = select('.form.preview');
    preview_form.innerHTML = '<h2>FLOORS\' LIST</h2>';

    deactivateAll('.form');
    deactivateAll('.btns');
    activateAll('.preview');

    if(floors.length > 0) {

        floors.forEach( floor => {
            let preview_tab = tab;
    
            preview_tab.querySelector('.tab-value').innerHTML = floor;
            preview_tab.querySelector('.action-btn:first-of-type').setAttribute('onclick', `edit_floor("${floor}")`);
            preview_tab.querySelector('.action-btn:last-of-type').setAttribute('onclick', `open_rooms("${floor}")`);
    
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

    select('.preview.btns .btn').innerHTML = 'ADD FLOOR';
    select('.preview.btns .btn').setAttribute('onclick', 'open_floor()');

    activate('.container');
    tracker.position = 'block';

}

function open_floor() {
    empty_input();
    select('.form.preview').setAttribute('style', '');
    deactivateAll('.form');
    deactivateAll('.btns');
    activateAll('.floor');

    select('.floor.btns .btn').setAttribute('onclick', 'add_floor()');
    select('.floor.btns .btn').innerHTML = 'ADD FLOOR';
    tracker.position = 'floor';
}

function edit_floor(floor) {

    select('.form.preview').setAttribute('style', '');
    deactivateAll('.form');
    deactivateAll('.btns');
    activateAll('.floor');

    select('input[name = "floor_name"]').value = floor;
    select('.floor.btns .btn').setAttribute('onclick', `update_floor("${floor}")`);
    select('.floor.btns .btn').innerHTML = 'UPDATE FLOOR';
    select('.floor h2').innerHTML = 'UPDATE FLOOR';

    activate('.delete-btn');
    select('.delete-btn').setAttribute('onclick', `delete_floor("${floor}")`);

    tracker.position = 'floor';
}

function add_floor() {
    
    let floor = select('input[name = "floor_name"]').value.toUpperCase();
    if(floor.replaceAll(' ', '').length > 0) {

        $.ajax({
            method: 'POST',
            url: 'php/add_floor.php',
            data: {
                facility_name:          selected.facility_name, 
                facility_type:          selected.facility_type, 
                facility_location:      selected.facility_location,
                facility_block:         selected.facility_block,
                floor_name:             floor,
            },
            success: (data) => {
                console.log(data);
                if(data == 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'FLOOR ADDED SUCCESSFULLY'
                    })

                    selected.floors[floor] = {};
                }
                else {
                    Swal.fire({
                        icon: 'info',
                        title: 'FLOOR ALREADY EXISTS',
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

function update_floor(floor) {
    let new_floor = select('input[name = "floor_name"]').value.toUpperCase();
    if(new_floor.replaceAll(' ', '').length > 0) {
        $.ajax({
            method: 'POST',
            url: 'php/update_floor.php',
            data: {
                facility_name:          selected.facility_name, 
                facility_type:          selected.facility_type, 
                facility_location:      selected.facility_location,
                facility_block:         selected.facility_block,
                floor_name:             new_floor,
                old_floor:              floor,

            },
            success: (data) => {
                console.log(data);
                if(data == 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'FLOOR UPDATED SUCCESSFULLY'
                    }).then(() => {
                        close_btn();
                    })

                    selected.floors[new_floor] = selected.floors[floor];
                    delete selected.floors[floor];
                }
                else {
                    Swal.fire({
                        icon: 'info',
                        title: 'FLOOR ALREADY EXISTS',
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
