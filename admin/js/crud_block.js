
function display_facility() {
    let blocks = Object.keys(selected.blocks);

    preview_form.innerHTML = '<h2>BLOCKS\' LIST</h2>';

    deactivateAll('.form');
    deactivateAll('.btns');
    activateAll('.preview');

    if(blocks.length > 0) {

        blocks.forEach( block => {
            let preview_tab = tab;
    
            preview_tab.querySelector('.tab-value').innerHTML = block;
            preview_tab.querySelector('.action-btn:first-of-type').setAttribute('onclick', `edit_block("${block}")`);
            preview_tab.querySelector('.action-btn:last-of-type').setAttribute('onclick', `open_floors("${block}")`);
    
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

    select('.preview.btns .btn').setAttribute('onclick', 'open_block()');

    activate('.container');
    tracker.position = 'modal'

}

function fetch_facility() {

    $.ajax({
        method: 'POST',
        url: 'php/fetch_facility.php',
        data: {
            facility_name:          selected.facility_name, 
            facility_type:          selected.facility_type, 
            facility_location:      selected.facility_location
        },
        success: (data) => {
            console.log(data);
            if(data == 'empty') {
                selected.blocks = {};
                display_facility();
                return false;
            }
            else {
                $.each(data, (key, block) => {
                    if( !(block.facility_block in selected.blocks)) 
                        selected.blocks[block.facility_block] = {};
                })
                display_facility();
            }
                        
        },
    });
}

function open_block() {
    select('.form.preview').setAttribute('style', '');
    deactivateAll('.form');
    deactivateAll('.btns');
    activateAll('.block');

    select('.block.btns .btn').setAttribute('onclick', 'add_block()');
    tracker.position = 'block';
}

function edit_block(block) {

    select('.form.preview').setAttribute('style', '');
    deactivateAll('.form');
    deactivateAll('.btns');
    activateAll('.block');

    select('input[name = "facility_block"]').value = block;
    select('.block.btns .btn').setAttribute('onclick', `update_block("${block}")`);
    select('.block.btns .btn').innerHTML = 'UPDATE BLOCK';
    select('.block h2').innerHTML = 'UPDATE BLOCK';

    activate('.delete-btn');
    select('.delete-btn').setAttribute('onclick', `delete_block("${block}")`);

    tracker.position = 'block';
}

function add_block() {
    let block = select('input[name = "facility_block"]').value.toUpperCase();
    if(block.replaceAll(' ', '').length > 0) {

        $.ajax({
            method: 'POST',
            url: 'php/add_block.php',
            data: {
                facility_name:          selected.facility_name, 
                facility_type:          selected.facility_type, 
                facility_location:      selected.facility_location,
                facility_block:         block,
            },
            success: (data) => {
                console.log(data);
                if(data == 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'BLOCK ADDED SUCCESSFULLY'
                    })

                    selected.blocks[block] = {};
                }
                else {
                    Swal.fire({
                        icon: 'info',
                        title: 'BLOCK ALREADY EXISTS',
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

function update_block(block) {
    let new_block = select('input[name = "facility_block"]').value.toUpperCase();
    if(new_block.replaceAll(' ', '').length > 0) {
        $.ajax({
            method: 'POST',
            url: 'php/update_block.php',
            data: {
                facility_name:          selected.facility_name, 
                facility_type:          selected.facility_type, 
                facility_location:      selected.facility_location,
                facility_block:         new_block,
                old_block:              block,

            },
            success: (data) => {
                console.log(data);
                if(data == 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'BLOCK UPDATED SUCCESSFULLY'
                    }).then(() => {
                        close_btn();
                    })

                    selected.blocks[new_block] = selected.blocks[block];
                    delete selected.blocks[block];
                }
                else {
                    Swal.fire({
                        icon: 'info',
                        title: 'BLOCK ALREADY EXISTS',
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

function delete_block(block) {
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

          if(block.replaceAll(' ', '').length > 0) {
            $.ajax({
                method: 'POST',
                url: 'php/delete_block.php',
                data: {
                    facility_name:          selected.facility_name, 
                    facility_type:          selected.facility_type, 
                    facility_location:      selected.facility_location,
                    old_block:              block,
    
                },
                success: (data) => {
                    console.log(data);
                    if(data == 'success'){
                        Swal.fire(
                            'Deleted!',
                            `${block} has been deleted.`,
                            'success'
                        ).then(() => {
                            close_btn();
                        })
                        delete selected.blocks[block];
                    }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR DELETING BLOCK',
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
