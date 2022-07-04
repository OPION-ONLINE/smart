let type = 'Hostel';

function search(query) {
    console.log('search');

    if(query.replaceAll(' ', '').length <= 0) {
        deactivate('.search-result');
        return false;
    }

    $.ajax({
        method: 'POST',
        url: environment_link + 'conn/home_page/search.php',
        data: {query: query, type: type.toLowerCase()},
        success: (data) => {
            if(data.length > 0) {
                activate('.search-result');
                let result = select('.search-result');
                result.innerHTML = '';
                
                data.forEach( facility =>  {
                    result.innerHTML += `
                    <div class = 'tab flex-col' onclick = 'location.href = "booking?facility_name=${facility['facility_name']}&facility_type=${facility['facility_type']}&facility_location=${facility['facility_location']}"'>
                        <span>${facility['facility_name']}</span>
                        <small>${facility['facility_location']}</span>
                    </div>`;
                })
            }
            else {
                deactivate('.search-result');
                
            }
            console.log(data);
        }
    })
}