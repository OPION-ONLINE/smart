
function status_check(status) {

    if(status == 'success') {
        Swal.fire({
            icon: 'success',
            title: 'SIGN UP SUCCESSFULL'
        })
    }

    else if(status == 'empty') {
        Swal.fire({
            icon: 'error',
            title: 'EMPTY INPUT',
            text: 'Please provide all inputs and try again',
        })
    }
    
}

select('form').addEventListener('submit', submit, false);

function submit(form) {

    form.preventDefault();

    $.ajax({
        method: 'POST',
        url: 'conn/verification/verify.php',
        data: {
            full_name: select('input[name = "full_name"]').value,
            phone_number: select('input[name = "phone_number"]').value
        },
        success: (data) => {
            console.log(data);
            status_check(data);
        }
    })
}