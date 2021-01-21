<?php
require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('');


print_r(($_POST));

$token = $_POST['stripeToken']; // This is a $20.00 charge in US Dollar.
$charge = \Stripe\Charge::create(
    array(
        'amount' => 2000,
        'currency' => 'usd',
        'source' => $token
    )
);

echo '<pre>';
print_r($charge);
echo '</pre>';


	//if success response is a charge API https://stripe.com/docs/api/charges/object
	// or https://stripe.com/docs/api/errors
/*
    Stripe\Charge Object
(
    [id] => ch_1G0l3uLli4ftaPvbgr5wQNhA
    [object] => charge
    [amount] => 2000
    [amount_refunded] => 0
    [application] => 
    [application_fee] => 
    [application_fee_amount] => 
    [balance_transaction] => txn_1G0l3uLli4ftaPvbpTvMQw3A
    [billing_details] => Stripe\StripeObject Object
        (
            [address] => Stripe\StripeObject Object
                (
                    [city] => 
                    [country] => 
                    [line1] => 
                    [line2] => 
                    [postal_code] => 31100
                    [state] => 
                )

            [email] => 
            [name] => 
            [phone] => 
        )

    [captured] => 1
    [created] => 1578991666
    [currency] => usd
    [customer] => 
    [description] => 
    [destination] => 
    [dispute] => 
    [disputed] => 
    [failure_code] => 
    [failure_message] => 
    [fraud_details] => Array
        (
        )

    [invoice] => 
    [livemode] => 
    [metadata] => Stripe\StripeObject Object
        (
        )

    [on_behalf_of] => 
    [order] => 
    [outcome] => Stripe\StripeObject Object
        (
            [network_status] => approved_by_network
            [reason] => 
            [risk_level] => normal
            [risk_score] => 45
            [seller_message] => Payment complete.
            [type] => authorized
        )

    [paid] => 1
    [payment_intent] => 
    [payment_method] => card_1G0l3tLli4ftaPvbVHWMNhbO
    [payment_method_details] => Stripe\StripeObject Object
        (
            [card] => Stripe\StripeObject Object
                (
                    [brand] => visa
                    [checks] => Stripe\StripeObject Object
                        (
                            [address_line1_check] => 
                            [address_postal_code_check] => pass
                            [cvc_check] => pass
                        )

                    [country] => US
                    [exp_month] => 12
                    [exp_year] => 2020
                    [fingerprint] => bFmX5WZxc99Do7K8
                    [funding] => credit
                    [installments] => 
                    [last4] => 4242
                    [network] => visa
                    [three_d_secure] => 
                    [wallet] => 
                )

            [type] => card
        )

    [receipt_email] => 
    [receipt_number] => 
    [receipt_url] => https://pay.stripe.com/receipts/acct_1AhMvzLli4ftaPvb/ch_1G0l3uLli4ftaPvbgr5wQNhA/rcpt_GXqlbIyZACBGbBxkYmULYxkqUBcXy6K
    [refunded] => 
    [refunds] => Stripe\Collection Object
        (
            [object] => list
            [data] => Array
                (
                )

            [has_more] => 
            [total_count] => 0
            [url] => /v1/charges/ch_1G0l3uLli4ftaPvbgr5wQNhA/refunds
        )

    [review] => 
    [shipping] => 
    [source] => Stripe\Card Object
        (
            [id] => card_1G0l3tLli4ftaPvbVHWMNhbO
            [object] => card
            [address_city] => 
            [address_country] => 
            [address_line1] => 
            [address_line1_check] => 
            [address_line2] => 
            [address_state] => 
            [address_zip] => 31100
            [address_zip_check] => pass
            [brand] => Visa
            [country] => US
            [customer] => 
            [cvc_check] => pass
            [dynamic_last4] => 
            [exp_month] => 12
            [exp_year] => 2020
            [fingerprint] => bFmX5WZxc99Do7K8
            [funding] => credit
            [last4] => 4242
            [metadata] => Stripe\StripeObject Object
                (
                )

            [name] => 
            [tokenization_method] => 
        )

    [source_transfer] => 
    [statement_descriptor] => 
    [statement_descriptor_suffix] => 
    [status] => succeeded
    [transfer_data] => 
    [transfer_group] => 
)

*/