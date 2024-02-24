<?php
use Paymentsds\MPesa\Client;
use Paymentsds\MPesa\Environment;

$client = new Client([
   'apiKey' => '<REPLACE>',             // API Key
   'publicKey' => '<REPLACE>',          // Public Key
   'serviceProviderCode' => 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', // Service Provider Code
   'environment' =>  Environment::SANDBOX // Environment. Use Environment::PRODUCTION  for production
]);

$paymentData = [
   'from' => '841234567',       // Customer MSISDN
   'reference' => '11114',      // Third Party Reference
   'transaction' => 'T12344CC', // Transaction Reference
   'amount' => '10'             // Amount
];

$result = $client->receive($paymentData);

if ($result->success) {
   // Handle success
} else {
   // Handle failure
}

?>