<?php
namespace nuffy\dao365;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::create(__DIR__.'/..');
$dotenv->load();

$api = new Dao($_ENV["DAO_USER"],$_ENV["DAO_APIKEY"]);
