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
                    
                })
            }
            else {
                deactivate('.search-result');
                
            }
            console.log(data);
        }
    })
}