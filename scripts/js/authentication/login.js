
function status_check(status) {

    if(status == 'exists') {
        Swal.fire({
            icon: 'success',
            title: 'LOG IN SUCCESSFULL'
        })
        setTimeout( () => {
            location.href = 'home';

        }, 3000)
    }

    else if(status == 'empty') {
        Swal.fire({
            icon: 'error',
            title: 'EMPTY INPUT',
            text: 'Please provide all inputs and try again',
        })
    }

    else {
        Swal.fire({
            icon: 'info',
            title: 'WRONG INPUT',
            text: 'Please provide correct inputs and try again',
        })
    }
    
}

select('form').addEventListener('submit', submit, false);

function submit(form) {

    form.preventDefault();

    $.ajax({
        method: 'POST',
        url: 'conn/login_page/login.php',
        data: {
            password: select('input[name = "password"]').value,
            phone_number: select('input[name = "phone_number"]').value
        },
        success: (data) => {
            console.log(data);
            status_check(data);
        }
    })
}