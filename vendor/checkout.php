<?php
require __DIR__. "/vendor/autoload.php";
$stripe_secret_key="sk_test_51QprK4HspNUtSzZSeLu1fLRzetLUk8I7uotk2Xlge9cuAuuSAEZxNkTnoKh1RcvTjHm6H7zrwX425g9sknQuzLwr00aG7tSPiM";
\Stripe\Stripe::setApikey($stripe_secret_key);
$checkout_session=\Stripe\Checkout\Session::create([
    "mode" => "payment",
   "success_url" => "success.html",
    "line_items" => [
        [
            "quantity" => 1,
        "price_data" => [
            "currency" => "lkr",
            "unit_amount" => 5000,
           "product_data" => [
                "name" => "tshirt",
            ]
        ]
        ]
    ]
           ]);
           http_response_code(303);
           header("Location:" . $checkout_session->url);
            
 
  
