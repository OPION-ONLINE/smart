let param = new URLSearchParams(window.location.search);
let ver = param.get('ver');

function status_check(status) {

    if(status == 'success') {
        Swal.fire({
            icon: 'success',
            title: 'PASSWORD UPDATE SUCCESSFULL'
        })

        setTimeout( () => {
            location.href = 'login';
        }, 3000)
    }

    else if(status == 'empty') {
        Swal.fire({
            icon: 'error',
            title: 'EMPTY INPUT',
            text: 'Please provide all inputs and try again',
        })
    }

    else if(status == 'expired') {
        Swal.fire({
            icon: 'info',
            title: 'VERIFICATION LINK EXPIRED ',
            text: 'Please verify and try again',
        })
    }

    else if(status == 'password') {
        Swal.fire({
            icon: 'error',
            title: 'PASSWORD MISS-MATCH',
            text: 'Please check your passwords and try again',
        })
    }

    else if(status == 'weak') {
        Swal.fire({
            icon: 'error',
            title: 'PASSWORD IS WEAK',
            text: 'Password should contain  at least 8 characters, a number, uppercase , lowercase, and a special character(eg. @&!),  ',
        })
    }
    
}

select('form').addEventListener('submit', submit, false);

function submit(form) {

    form.preventDefault();

    $.ajax({
        method: 'POST',
        url: 'conn/newpassword/create.php?ver='+ ver,
        data: {
            password: select('input[name = "password"]').value,
            confirm_password: select('input[name = "confirm_password"]').value
        },
        success: (data) => {
            console.log(data);
            status_check(data);
        }
    })
}