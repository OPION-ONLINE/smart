<?php
if(isset($_POST['email']) && isset($_POST['message'])) {
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    if(filter_var($email, FILTER_VALIDATE_EMAIL) && mail('opiononline@gmail.com', 'FEEDBACK', $message)) {
        echo "success";
        exit();
    }

}
?>

<footer>
    <div class = 'flex-center'>
        <div class = 'footer-left flex-col flex-center'>
            <div class = 'logo'>H-CUBE</div>
            <div class = 'flex-row'>
                <div class = 'social flex-center round'>
                    <i class = 'bi bi-whatsapp'></i>
                </div>
                <div class = 'social flex-center round'>
                    <i class = 'bi bi-twitter'></i>
                </div>
                <div class = 'social flex-center round'>
                    <i class = 'bi bi-envelope'></i>
                </div>
            </div>
        </div>
        <div class = 'footer-right flex-col flex-center'>
            <input type = 'email' name = 'email' placeholder="Email..." class = 'email'>
            <textarea name="message" placeholder="Message..." class = 'message'></textarea>
            <div class = 'btn ' style = 'background-color: var(--secondary-color); color: var(--primary-color); padding: .75rem 1rem; border-radius: 5rem; width: 200px;' onclick = 'sendMail();'>Submit</div>
        </div>
    </div>

    <div class = 'footer-bottom full-w p-2 text-center'>© Copyright 2022, OPION </div>
</footer>

<script>
    function sendMail() {
       let email = select('footer .email').value;
       let message = select('footer .message').value;

       if(email.replaceAll(" ", '') == "" || message.replaceAll(" ", '') == "") {
            Swal.fire({
                icon: "error",
                title: "EMPTY EMAIL OR MESSAGE",
                text: "please type in a valid email or message and try again."
            });
       }
       else {
            select('footer .email').value = "";
            select('footer .message').value = "";

            $.ajax({
                method: 'POST',
                url:     'templates/components/footer.php',
                data: {email: email, message: message},
                success: (data) => {
                    
                    console.log(data);

                    if(data == 'success') {
                        Swal.fire({
                            icon: "success",
                            title: "MESSAGE SENT",
                        });
                    }
                    else {
                        Swal.fire({
                            icon: "error",
                            title: "INVALID EMAIL",
                            text: "please provide a valid email and try again"
                        })
                    }
                }
            });
       }
    }
</script>
