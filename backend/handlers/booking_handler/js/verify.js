const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
  });
  // Get the value of "some_key" in eg "https://example.com/?some_key=some_value"
let booking_id = params.booking_id; // "some_value"

console.log(booking_id);
document.querySelector('input').value = booking_id;

function verify_payment() {
    let php_url_base = '../backend/handlers/booking_handler/php/';
    activate('.loader');
    $.ajax({
        method: 'POST',
        url: php_url_base + 'verify.php',
        data: {booking_id: document.querySelector('input').value},
        success: (data) => {
            deactivate('.loader');
            console.log(data);
            if(data == 'verified') {
                Swal.fire({
                    icon: 'success',
                    title: 'VERIFIED',
                    text: `Payment by booking ${booking_id} has been verified!`,
                    footer: '<a href="booking.php">Booking Panel</a>'
                  })
            }
            else {
                Swal.fire({
                    icon: 'error',
                    title: 'VERIFICATION ERROR',
                    text: 'Could not verify transaction',
                  })
            }
        }
    });
}