let php_url_base = '../backend/handlers/admin_home/php/';

$.ajax({
    method: 'POST',
    url: php_url_base + 'fetch.php',
    success: (data) => {
        console.log(data);

        $.each(data, (key, value) => {
            document.querySelector(`.${key}`).innerHTML = value;
        });

       
    }
})