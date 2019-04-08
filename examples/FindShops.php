<?php
namespace nuffy\dao365;

require_once __DIR__.'/Setup.php';

$request = new request\FindShops(2610, "Islevdalvej 148");
$response = $api->request($request);

var_dump($response);
