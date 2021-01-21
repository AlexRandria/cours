<!DOCTYPE html>
<html>

<head>
  <title>Stripe web payment</title>
  <script src="https://js.stripe.com/v3/"></script>
  expire
</head>

<body>
  <style type="text/css">
    .StripeElement {
      background-color: white;
      padding: 8px 12px;
      border-radius: 4px;
      border: 1px solid transparent;
      box-shadow: 0 1px 3px 0 #e6ebf1;
      -webkit-transition: box-shadow 150ms ease;
      transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
      box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
      border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
      background-color: #fefde5 !important;
    }
  </style>
  <form action="charge.php" method="post" id="payment-form">
    <div class="form-row">
      <label for="card-element">
        Credit or debit card
      </label>
      <div id="card-element">
        <!-- A Stripe Element will be inserted here. -->
      </div>

      <!-- Used to display Element errors. -->
      <div id="card-errors" role="alert"></div>
    </div>

    <button>Submit Payment</button>
  </form>
</body>
<script type="text/javascript">
  // Set your publishable key: remember to change this to your live publishable key in production
  // See your keys here: https://dashboard.stripe.com/account/apikeys
  var stripe = Stripe('pk_test_51I7McdJRZHZ9LFluN3dyQzI8Lb0OJoMWerH7gOu5wuQkjM8iO5CG8OnuEuPofqq3m1z5sjeogDqX0dywaZLh3MxF00FUYTuFdT');
  var elements = stripe.elements();

  // Custom styling can be passed to options when creating an Element.
  var style = {
    base: {
      // Add your base input styles here. For example:
      fontSize: '16px',
      color: '#32325d',
    },
  };

  // Create an instance of the card Element.
  var card = elements.create('card', {
    style: style
  });

  // Add an instance of the card Element into the `card-element` <div>.
  card.mount('#card-element');



  // Create a token or display an error when the form is submitted.
  var form = document.getElementById('payment-form');
  form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
      if (result.error) {
        // Inform the customer that there was an error.
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
      } else {
        console.log(result.id)
        // Send the token to your server.
        debugger
        stripeTokenHandler(result.token);
      }
    });
  });

  function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
  }

  /*

      this.cardDetails = {
        number: '4242424242424242',
        expMonth: 12,
        expYear: 2020,
        cvc: '220'
      }

  RESPONSE FROM STRIPE: id is the token to be sent to the server
  {
    "id": "tok_1GXpyELli4ftaPvbfudCur6P",
    "object": "token",
    "card": {
      "id": "card_1GXpyELli4ftaPvb5Uhmj7dM",
      "object": "card",
      "address_city": null,
      "address_country": null,
      "address_line1": null,
      "address_line1_check": null,
      "address_line2": null,
      "address_state": null,
      "address_zip": "31100",
      "address_zip_check": "unchecked",
      "brand": "Visa",
      "country": "US",
      "cvc_check": "unchecked",
      "dynamic_last4": null,
      "exp_month": 12,
      "exp_year": 2020,
      "funding": "credit",
      "last4": "4242",
      "metadata": {
      },
      "name": null,
      "tokenization_method": null
    },
    "client_ip": "90.76.140.209",
    "created": 1586875358,
    "livemode": false,
    "type": "card",
    "used": false
  }



  */
</script>

</html>