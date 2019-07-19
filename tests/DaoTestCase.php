<?php
namespace nuffy\dao365\tests;

use PHPUnit\Framework\TestCase;

class DaoTestCase extends TestCase
{
    /** @var \nuffy\dao365\Dao The guzzle client for api communications during tests. */
    protected static $client;

    public static function setUpBeforeClass() : void
    {
        $dotenv = \Dotenv\Dotenv::create(__DIR__);
        $dotenv->load();

        self::$client = new \nuffy\dao365\Dao($_ENV["DAO_USER"],$_ENV["DAO_APIKEY"]);
    }
}