//delete something
Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
      )
    }
  })

//accept user input
  Swal.fire({
    title: 'Submit your Github username',
    input: 'text',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Look up',
    showLoaderOnConfirm: true,
    preConfirm: (login) => {
      if(login == "" || login.length < 5) {
        Swal.fire({
          icon: 'error',
          title: 'Name is to short',
          text: 'Please enter a full name (firstname and lastname)',
        })
        return false;
      }
      return true;
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    if (result) {
      Swal.fire({
        icon: 'success',
      })
    }
  })

  //error message
  Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'Something went wrong!',
    footer: '<a href="">Why do I have this issue?</a>'
  })

  
  {

  "status": true,

  "message": "Transaction retrieved",

  "data": {

    "id": 292584114,

    "domain": "test",

    "status": "success",

    "reference": "203520101",

    "amount": 10000,

    "message": null,

    "gateway_response": "Successful",

    "paid_at": "2019-10-09T13:03:28.000Z",

    "created_at": "2019-10-09T13:00:16.000Z",

    "channel": "card",

    "currency": "NGN",

    "ip_address": "197.211.43.98",

    "metadata": {

      "custom_fields": [

        {

          "display_name": "Mobile Number",

          "variable_name": "mobile_number",

          "value": "+2348012345678"

        }

      ],

      "referrer": "http://localhost:3001/integration/microphone.html?"

    },

    "log": {

      "start_time": 1570626018,

      "time_spent": 192,

      "attempts": 1,

      "errors": 0,

      "success": true,

      "mobile": false,

      "input": [],

      "history": [

        {

          "type": "action",

          "message": "Attempted to pay with card",

          "time": 191

        },

        {

          "type": "success",

          "message": "Successfully paid with card",

          "time": 192

        }

      ]

    },

    "fees": 150,

    "fees_split": null,

    "authorization": {

      "authorization_code": "AUTH_2e4k18sj52",

      "bin": "408408",

      "last4": "4081",

      "exp_month": "12",

      "exp_year": "2020",

      "channel": "card",

      "card_type": "visa DEBIT",

      "bank": "Test Bank",

      "country_code": "NG",

      "brand": "visa",

      "reusable": true,

      "signature": "SIG_JrPFkMYhcu8AD75eQWKl",

      "account_name": "BoJack Horseman"

    },

    "customer": {

      "id": 1809887,

      "first_name": null,

      "last_name": null,

      "email": "customer@email.com",

      "customer_code": "CUS_0c35ys9w8ma5tbr",

      "phone": null,

      "metadata": null,

      "risk_action": "deny"

    },

    "plan": {},

    "subaccount": {},

    "order_id": null,

    "paidAt": "2019-10-09T13:03:28.000Z",

    "createdAt": "2019-10-09T13:00:16.000Z",

    "requested_amount": 1500000

  }

}