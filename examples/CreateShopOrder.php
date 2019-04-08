<?php
namespace nuffy\dao365;

require_once __DIR__.'/Setup.php';

$receiver = new Receiver("Esben Tind", "Islevdalvej 148", "2610", 28922322, "esben@inkpro.dk");
$order = new request\CreateShopOrder(null, $receiver, (new \DateTime("tomorrow"))->modify("+1 day"), "100", [6,10,1], 87654321, null, true);
$response = $api->request($order);

var_dump($response);
