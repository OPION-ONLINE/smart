
function open_plans(plan, gender) {
    selected.plan = plan;
    selected.gender = gender;

    deactivateAll('.form');
    deactivateAll('.btns');
    activateAll('.preview');

    fetch_plan();
    
}

function fetch_plan() {
    console.log(selected.gender);
    $.ajax({
        method: 'POST',
        url: 'php/fetch_plan.php',
        data: {
            facility_name:          selected.facility_name, 
            facility_type:          selected.facility_type, 
            facility_location:      selected.facility_location,
            facility_block:         selected.facility_block,
            floor_name:             selected.floor_name,
            room_type:              selected.room_type,
            gender:                 selected.gender,
        },
        success: (data) => {
            console.log(data);
            if(data == 'empty') {
                selected.plans = {};
                display_plan();
                return false;
            }
            else {
                $.each(data, (key, plan) => {
                    if( !(plan.plan_info_one in selected.plans)) 
                        selected.plans[plan.plan_info_one] = {
                            plan_info_one:             plan.plan_info_one,
                            plan_info_two:                 plan.plan_info_two,
                            price:            plan.price
                        };
                })
                display_plan();
            }
                        
        },
    });
}

function display_plan() {
    let plans = Object.keys(selected.plans);


    let preview_form = select('.form.preview');
    preview_form.innerHTML = '<h2>PLANS\' LIST</h2>';

    deactivateAll('.form');
    deactivateAll('.btns');
    activateAll('.preview');

    if(plans.length > 0) {

        plans.forEach( plan => {
            let preview_tab = tab;
    
            preview_tab.querySelector('.tab-value').innerHTML = plan;
            preview_tab.querySelector('.action-btn:first-of-type').setAttribute('onclick', `edit_plan("${plan}")`);
            preview_tab.querySelector('.action-btn:last-of-type').setAttribute('onclick', `close_btn();`)
    
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

    select('.preview.btns .btn').innerHTML = 'ADD PLAN';
    select('.preview.btns .btn').setAttribute('onclick', 'open_plan()');

    activate('.container');
    tracker.position = 'room';

}

function open_plan() {
    select('.form.preview').setAttribute('style', '');
    deactivateAll('.form');
    deactivateAll('.btns');
    activateAll('.plan');

    select('.plan.btns .btn').setAttribute('onclick', 'add_plan()');
    select('.plan.btns .btn').innerHTML = 'ADD PLAN';
    select('.plan h2').innerHTML = 'ADD PLAN';
    tracker.position = 'plan';
}

function edit_plan(plan) {

    select('.form.preview').setAttribute('style', '');
    deactivateAll('.form');
    deactivateAll('.btns');
    activateAll('.plan');

    select('input[name = "plan_info_one"]').value = plan;
    select('input[name = "plan_info_two"]').value = selected.plans[plan].plan_info_two;                 
    select('input[name = "price"]').value    = selected.plans[plan].price;                 


    select('.plan.btns .btn').setAttribute('onclick', `update_plan("${plan}", "${selected.plans[plan].plan_info_two}")`);
    select('.plan.btns .btn').innerHTML = 'UPDATE PLAN';
    select('.plan h2').innerHTML = 'UPDATE PLAN';

    activate('.delete-btn');
    select('.delete-btn').setAttribute('onclick', `delete_plan("${plan}", "${selected.plans[plan].plan_info_two}")`);

    tracker.position = 'plan';
}

function add_plan() {
    let plan_info_one = select('input[name = "plan_info_one"]').value.toUpperCase();
    let plan_info_two = select('input[name = "plan_info_two"]').value.toUpperCase();
    let price = select('input[name = "price"]').value.toUpperCase();

    let empty = (
        plan_info_one.replaceAll(' ', '').length <= 0                                      ||
        plan_info_two.replaceAll(' ', '').length <= 0                                ||
        price.replaceAll(' ', '').length <= 0                                          
                   
    );

    if(!empty) {

        $.ajax({
            method: 'POST',
            url: 'php/add_plan.php',
            data: {
                facility_name:          selected.facility_name, 
                facility_type:          selected.facility_type, 
                facility_location:      selected.facility_location,
                facility_block:         selected.facility_block,
                floor_name:             selected.floor_name,
                room_type:              selected.room_type,
                gender:                 selected.gender,
                plan_info_one:             plan_info_one,
                plan_info_two:                 plan_info_two,
                price:            price

            },
            success: (data) => {
                console.log(data);
                if(data == 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'plan ADDED SUCCESSFULLY'
                    })

                    selected.plans[plan_info_one] = {
                        plan_info_two:             plan_info_two,
                        plan_info_one:                 plan_info_one,
                        price:            price
                    };
                }
                else {
                    Swal.fire({
                        icon: 'info',
                        title: 'plan ALREADY EXISTS',
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

function update_plan(plan, plan_two) {

    let new_plan_info_one = select('input[name = "plan_info_one"]').value.toUpperCase();
    let new_plan_info_two = select('input[name = "plan_info_two"]').value.toUpperCase();
    let price = select('input[name = "price"]').value.toUpperCase();

    let empty = (
        new_plan_info_one.replaceAll(' ', '').length <= 0                                      ||
        new_plan_info_two.replaceAll(' ', '').length <= 0                                ||
        price.replaceAll(' ', '').length <= 0         
                   
    );
    if(!empty) {
        $.ajax({
            method: 'POST',
            url: 'php/update_plan.php',
            data: {
                facility_name:          selected.facility_name, 
                facility_type:          selected.facility_type, 
                facility_location:      selected.facility_location,
                facility_block:         selected.facility_block,
                floor_name:             selected.floor_name,
                room_type:              selected.room_type,
                plan_info_one:          new_plan_info_one,
                plan_info_two:                 new_plan_info_two,
                price:            price,
                old_plan_one:           plan,
                old_plan_two:           plan_two,
                gender:         selected.gender,

            },
            success: (data) => {
                console.log(data);
                if(data == 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'plan UPDATED SUCCESSFULLY'
                    }).then(() => {
                        close_btn();
                    })

                    selected.plans[new_plan_info_one] = selected.plans[plan];
                    delete selected.rooms[plan];
                    selected.plans[new_plan_info_one].plan_info_two = new_plan_info_two;
                    selected.plans[new_plan_info_one].plan_info_one = new_plan_info_one;
                    selected.plans[new_plan_info_one].price = price;
                }
                else {
                    Swal.fire({
                        icon: 'info',
                        title: 'plan ALREADY EXISTS',
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

function delete_plan(plan, plan_two) {
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

          if(plan.replaceAll(' ', '').length > 0 && plan_two.replaceAll(' ', '').length > 0) {
            $.ajax({
                method: 'POST',
                url: 'php/delete_plan.php',
                data: {
                    facility_name:          selected.facility_name, 
                    facility_type:          selected.facility_type, 
                    facility_location:      selected.facility_location,
                    facility_block:         selected.facility_block,
                    floor_name:             selected.floor_name,
                    room_type:              selected.room_type,
                    old_plan_one:               plan,
                    old_plan_two:             plan_two,
                    gender:                 selected.gender,
    
                },
                success: (data) => {
                    console.log(data);
                    if(data == 'success'){
                        Swal.fire(
                            'Deleted!',
                            `${plan} for ${plan_two} has been deleted.`,
                            'success'
                        ).then(() => {
                            close_btn();
                        })
                        delete selected.plans[plan];
                    }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR DELETING PLAN',
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
