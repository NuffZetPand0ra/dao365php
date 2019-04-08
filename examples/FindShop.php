<?php
namespace nuffy\dao365;

require_once __DIR__.'/Setup.php';

$response = $api->findShop(95784);

var_dump($response);
