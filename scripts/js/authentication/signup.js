
let param = new URLSearchParams(window.location.search);

console.log(param);

function status_check(status) {

    if(status == 'success') {
        Swal.fire({
            icon: 'success',
            title: 'SIGN UP SUCCESSFULL'
        })
        location.href = 'home';
    }

    else if(status == 'empty') {
        Swal.fire({
            icon: 'error',
            title: 'EMPTY INPUT',
            text: 'Please provide all inputs and try again',
        })
    }

    else if(status == 'email') {
        Swal.fire({
            icon: 'error',
            title: 'INVALID EMAIL',
            text: 'Please provide a valid email and try again',
        })
    }

    else if(status == 'password') {
        Swal.fire({
            icon: 'error',
            title: 'PASSWORD MISS-MATCH',
            text: 'Please check your passwords and try again',
        })
    }

    else if(status == 'exists') {
        Swal.fire({
            icon: 'info',
            title: 'USER EXISTS',
            text: 'Seems you already have an account, please login to use H-CUBE',
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
        url: 'conn/signup_page/signup.php',
        data: {
            full_name: select('input[name = "full_name"]').value,
            phone_number: select('input[name = "phone_number"]').value,
            email: select('input[name = "email"]').value,
            gender: select('select[name = "gender"]').value,
            status: select('select[name = "status"]').value,
            password: select('input[name = "password"]').value,
            confirm_password: select('input[name = "confirm_password"]').value,
    
        },
        success: (data) => {
            console.log(data);
            status_check(data);
        }
    })
}