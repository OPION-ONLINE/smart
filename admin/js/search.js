function search_facilities(search_query, start_id = 0, limit = 10, empty = true) {
    tracker.facility_id = 0;

    if(search_query == '') 
    {
        entry_table.innerHTML = '';
        fetch_facilities(10);
        document.querySelector('.show-more-btn .btn').remove();
        document.querySelector('.show-more-btn').innerHTML = `
            <div class = 'btn' onclick = 'show_more();'>Show More</div>
        `;
        return 0;
    }

    if(empty) entry_table.innerHTML = '';
    $.ajax({
        method: 'POST',
        url: '../backend/handlers/facility_handler/php/search_facilities.php', // make request to facility handler
        data: {search_query: clean_reverse(search_query), start_id: start_id, limit: limit, start_date: tracker.start_date, end_date: tracker.end_date}, //provide facility_name and limit(number of facilities to return)
        success: function(data) {
            
            //add response facilities to facility table
            data.forEach( value => {
                let table_entry = document.createElement('div');
                table_entry.setAttribute('class', 'table-entry');
                table_entry.setAttribute('onclick', 'select_table(this);')
                table_entry.innerHTML = `
                    <div class = 'te te-name'>${value['facility_name']}</div>
                    <div class = 'te te-number'>${value['facility_contact']}</div>
                    <div class = 'te te-location'>${value['facility_location']}</div>
                    <div class = 'te te-date'>${value['facility_date']}</div>
                    <div class = 'te te-action'>
                        <div class = 'btn'>Edit</div>
                    </div>
                `;
                tracker.search_id = value['id'];


                let edit_btn    = table_entry.querySelector('.te-action');
                let name        = clean(value['facility_name']);
                let type        = clean(value['facility_type']);
                let location    = clean(value['facility_location']);

                edit_btn.innerHTML = `
                    <div class = 'btn' onclick = "edit_facility(\`${name}\`, \`${type}\`,  \`${location}\`)">Edit</div>
                `;


                

                entry_table.appendChild(table_entry);
                
            });
            document.querySelector('.show-more-btn .btn').remove();
            document.querySelector('.show-more-btn').innerHTML = `
                <div class = 'btn' onclick = 'search_facilities("${clean(search_query)}", ${tracker.search_id}, 10, false);'>Show More</div>
            `;
            
        }
    
    })
}

function calender_facilities() {
    tracker.start_date = document.querySelector('.start-date').value;
    tracker.end_date = document.querySelector('.end-date').value;
    tracker.facility_id = 0;
    if(tracker.start_date != '' && tracker.end_date != '') {
        entry_table.innerHTML = '';
        fetch_facilities(10);
    }
}