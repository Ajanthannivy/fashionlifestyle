<?php
define('STRIPE_SECRET_KEY', 'sk_test_51QprK4HspNUtSzZSeLu1fLRzetLUk8I7uotk2Xlge9cuAuuSAEZxNkTnoKh1RcvTjHm6H7zrwX425g9sknQuzLwr00aG7tSPiM');
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51QprK4HspNUtSzZSj4kVoiyruYK66vOuxaAHjpIEaWdOrmMv7YhaUknLza3SY9A5xmycyLJQqQtrvA65nr3oCfpu005JCbQZCj');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment Form</title>
    <script>
        var STRIPE_PUBLISHABLE_KEY = "<?php echo STRIPE_PUBLISHABLE_KEY; ?>";
        console.log("Stripe Key Loaded: ", STRIPE_PUBLISHABLE_KEY); // Debugging
    </script>
</head>

<body>
    <form id="payment-form" action="charge.php" method="post">
        <input type="text" name="customer_name" placeholder="Enter your name" required>
        <input type="email" name="customer_email" placeholder="Enter your email" required>

        <!-- Card Input -->
        <div id="card-element"></div>
        <div id="card-errors" role="alert"></div>

        <!-- Hidden Stripe Token -->
        <input type="hidden" id="stripeToken" name="stripeToken">

        <button type="submit">Pay Now</button>
    </form>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var stripe = Stripe(STRIPE_PUBLISHABLE_KEY);
            var elements = stripe.elements();
            var card = elements.create("card");
            card.mount("#card-element");

            var form = document.getElementById("payment-form");
            var cardErrors = document.getElementById("card-errors");

            card.addEventListener('change', function(event) {
                if (event.error) {
                    cardErrors.textContent = event.error.message;
                } else {
                    cardErrors.textContent = '';
                }
            });

            form.addEventListener("submit", function(event) {
                event.preventDefault();
                console.log("Form Submitted, Creating Token..."); // Debugging

                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        console.log("Stripe Error:", result.error.message); // Debugging
                        cardErrors.textContent = result.error.message;
                    } else {
                        console.log("Generated Token: ", result.token.id); // Debugging
                        document.getElementById("stripeToken").value = result.token.id;
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>
