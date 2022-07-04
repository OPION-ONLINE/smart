
function open_facility() {
    $.ajax({
        method: 'POST',
        url: 'php/open_facility.php',
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
                $.each(data, (key, facility) => {
                    
                        selected.facility_description = facility.facility_description;
                        selected.facility_contact     = facility.facility_contact;
                        selected.facility_state       = facility.facility_state;
                        selected.cover_image          = facility.cover_image;
                        selected.rating               = facility.rating;
                })
                activate_facility();
            }
                        
        },
    });
}

function activate_facility() {
    
    deactivateAll('.form');
    deactivateAll('.btns');
    activateAll('.facilities');

    select('input[name = "facility_name"]').value = selected.facility_name;
    select('select[name = "facility_type"]').value = selected.facility_type;
    select('input[name = "facility_location"]').value = selected.facility_location;
    select('input[name = "facility_contact"]').value = selected.facility_contact;
    select('select[name = "facility_state"] option[selected]').innerHTML = selected.facility_state;
    select('textarea[name = "facility_description"]').value = selected.facility_description;
    select('.cover_image').src = '../image_server/' + selected.cover_image;
    select('input[name = "rating"]').value = selected.rating;

    
    activate('.delete-btn');
    select('.delete-btn').setAttribute('onclick', `delete_facility()`);
    
    select('.facilities.btns .btn').setAttribute('onclick', 'update_facility()');

    activate('.container');
    tracker.position = 'root';
}

function update_facility() {

    let facility_name   =          select('input[name = "facility_name"]').value.toLowerCase();
    let facility_location   =      select('input[name = "facility_location"]').value.toLowerCase();
    let facility_contact  =        select('input[name = "facility_contact"]').value;
    let facility_description  =    select('textarea[name = "facility_description"]').value.toLowerCase()
    let facility_state  =          select('select[name = "facility_state"]').value.toLowerCase();
    let cover_image  =             select('.cover_image').src.replaceAll(path + 'image_server/', '');
    console.log(cover_image);
    let rating  =                  select('input[name = "rating"]').value.toLowerCase()

    let empty = (
        facility_name.replaceAll(' ', '').length <= 0 ||
        facility_location.replaceAll(' ', '').length <= 0 ||
        facility_contact.replaceAll(' ', '').length <= 0 ||
        facility_description.replaceAll(' ', '').length <= 0 ||
        facility_state.replaceAll(' ', '').length <= 0 ||
        cover_image.replaceAll(' ', '').length <= 0 ||
        rating.replaceAll(' ', '').length <= 0
    );

    if(!empty) {
        $.ajax({
            method: 'POST',
            url: 'php/update_facility.php',
            data: {
                facility_name:          facility_name, 
                facility_location:      facility_location,
                
                old_facility_name:      selected.facility_name,  
                facility_type:          selected.facility_type, 
                old_facility_location:  selected.facility_location,

                facility_contact:       facility_contact,
                facility_description:   facility_description,
                facility_state:         facility_state,
                cover_image:            cover_image, 
                rating:                 rating, 
                

            },
            success: (data) => {
                console.log(data);
                if(data == 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'FACILITY UPDATED SUCCESSFULLY'
                    })

                    selected.facility_name        = facility_name;
                    selected.facility_location    = facility_location;
                    selected.facility_description = facility_description;
                    selected.facility_contact     = facility_contact;
                    selected.facility_state       = facility_state;
                    selected.cover_image          = cover_image;
                    selected.rating               = rating;
                }
                else {
                    Swal.fire({
                        icon: 'info',
                        title: 'FACILITY ALREADY EXISTS',
                        text: 'If you cant access facility, please contact Opion tech support',
                    })
                }
            }
        })
    }
    else {
        Swal.fire({
            icon: 'error',
            title: 'EMPTY INPUT',
            text: 'Please type in all details and try again',
        })
    }
}

function delete_facility() {
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


            $.ajax({
                method: 'POST',
                url: 'php/delete_facility.php',
                data: {
                    facility_name:          selected.facility_name, 
                    facility_type:          selected.facility_type, 
                    facility_location:      selected.facility_location,

                },
                success: (data) => {
                    console.log(data);
                    if(data == 'success'){
                        Swal.fire(
                            'Deleted!',
                            `${selected.facility_name} has been deleted.`,
                            'success'
                        ).then(() => {
                           close_btn();
                        })
                        selected = {
                            facility_name:     '',
                            facility_type:     '',
                            facility_location: '',
                            blocks: {},
                        }
                        
                    }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR DELETING FACILITY',
                            text: 'If you cant access facility, please contact Opion tech support',
                        })
                    }
                }
            })
        
        }
      })


}
