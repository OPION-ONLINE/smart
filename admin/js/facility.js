let today = new Date();
let selected = {
    facility_name:     '',
    facility_type:     '',
    facility_location: '',
    facility_description: '',
    facility_location: '',
    facility_contact: '',
    facility_state: '',
    cover_image: '',
    rating: '',
    blocks: {},
    facility_block: '',
    floors: {},
    rooms: {},
    room_type: '',
}

let tracker = {
    facility_id: 0,
    start_date: '1888-11-11',
    end_date:   `${today.getFullYear()}-${today.getMonth() + 1}-${today.getDate()}`,
    position: 'root',
}

let entry_table = select('.table'); // select facility table
entry_table.innerHTML = ''; //clear table

let preview_form = select('.form.preview');

let tab = select('.input.tab');

let path = 'http://localhost/me/newscratch/';

function display_facilities(data) {
    data.forEach( value => {
        let table_entry = document.createElement('div');
        table_entry.setAttribute('class', 'table-entry');
        // table_entry.setAttribute('onclick', 'select_table(this);')
        table_entry.innerHTML = `
            <div class = 'te te-name'>${value['facility_name']}</div>
            <div class = 'te te-number'>${value['facility_contact']}</div>
            <div class = 'te te-location'>${value['facility_location']}</div>
            <div class = 'te te-date'>${value['facility_date']}</div>
            <div class = 'te te-action'>
                <div class = 'btn'>Edit</div>
            </div>
        `;
        tracker.facility_id = value['id'];

        let edit_btn    = table_entry.querySelector('.te-action');
        let name        = clean(value['facility_name']);
        let type        = clean(value['facility_type']);
        let location    = clean(value['facility_location']);

        edit_btn.innerHTML = `
            <div class = 'btn' onclick = "edit_facility(\`${name}\`, \`${type}\`,  \`${location}\`)">Edit</div>
        `;

        entry_table.appendChild(table_entry);
        
    });
}

function fetch_facilities(limit) {

    $.ajax({
        method: 'POST',
        url: 'php/fetch_facilities.php',
        data: {
            start_id:       tracker.facility_id,
            limit:          limit, 
            start_date:     tracker.start_date, 
            end_date:       tracker.end_date
        },
        success: (data) => {
            console.log('successfull')
            console.log(data);
            display_facilities(data);
        },
    });
}

fetch_facilities(10);


function edit_facility(name, type, location) {
    selected.facility_name = name;
    selected.facility_type = type;
    selected.facility_location = location;

    // fetch_facility();
    open_facility();
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

function close_btn() {
    deactivate('.delete-btn');
    select('.delete-btn').setAttribute('onclick', ``);

    preview_form.setAttribute('style', '')

    if(tracker.position == 'root') {
        deactivate('.container');
        tracker.position = '';
    }
    else if( tracker.position == 'modal') {
        deactivateAll('.form');
        activate_facility();
    }
    else if( tracker.position == 'block') {
        deactivateAll('.form');
        display_facility();
    }
    else if( tracker.position == 'floor') {
        deactivateAll('.form');
        display_floor();
    }
}