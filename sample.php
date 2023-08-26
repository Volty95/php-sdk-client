<?php

use Remesita\ApiClient;

require_once __DIR__ . '/vendor/autoload.php';
$apiKey = "";
$apiSecret = "";
$api = new ApiClient($apiKey, $apiSecret);

//Asi creas el link de pagos
$businessId="TU BUSINESS ID";
print_r($api->createPaymentLink(
    $businessId,
    120,
    "Toma chocolate paga lo que debes",
    "MYID123",
    "https://miweb.com/ipn?id=MYID123",
    "https://miweb.com/checkout/success",
    "https://miweb.com/checkout/canceled",
    "Nombre del CLiente", //opcional
    "Phone del cliente", //opcional
    "Email del cliente" //opcional

));
 




//print_r($api->getOrders());
//print_r($api->getBusinesses());
//print_r($api->getP2POperations());
/*

$from = new \DateTime("now - 30 days");
$to = new \DateTime("now");
$pg = 1;
$pgSize = 25;
$paginnation = $api->getOrders(
    $from,
    $to,
    $pg,
    $pgSize
);
foreach ($paginnation as $t) {
    print_r($t);
}
*/ 

