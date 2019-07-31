<?php
namespace nuffy\dao365\tests;

final class DaoTest extends DaoTestCase
{    
    public function testCanCreateDirectOrder()
    {
        $receiver = new \nuffy\dao365\Receiver("Esben Tind", "Islevdalvej 148", "2610", 28922322, "esben@inkpro.dk");
        $order = new \nuffy\dao365\request\CreateDirectOrder($receiver, (new \DateTime("tomorrow"))->modify("+1 day"), "100", [6,10,1], 87654321, null, false, true);
        $response = self::$client->request($order);
        $this->assertInstanceOf(\nuffy\dao365\response\DirectOrderLabel::class, $response, "Cannot create new direct order label.");
    }
    
    /**
     * @depends testCanCreateDirectOrder
     */
    public function testCanCreateShopOrder()
    {
        $receiver = new \nuffy\dao365\Receiver("Esben Tind", "Islevdalvej 148", "2610", 28922322, "esben@inkpro.dk");
        $order = new \nuffy\dao365\request\CreateShopOrder(null, $receiver, (new \DateTime("tomorrow"))->modify("+1 day"), "100", [6,10,1], 87654321, null, false, true);
        $response = self::$client->request($order);
        $this->assertInstanceOf(\nuffy\dao365\response\DirectOrderLabel::class, $response, "Cannot create new shop order label.");
    }

    public function testCanConvertAliasLetters()
    {
        $receiver = new \nuffy\dao365\Receiver("Stine Rohde", "Møllegården 191", "6933", 28922322, "esben@inkpro.dk");
        $order = new \nuffy\dao365\request\CreateDirectOrder($receiver, (new \DateTime("tomorrow"))->modify("+1 day"), "100", [6,10,1], 87654321, null, false, true);
        $response = self::$client->request($order);
        $this->assertInstanceOf(\nuffy\dao365\response\DirectOrderLabel::class, $response, "Cannot convert å to aa in DAO api.");
    }

    public function testCanSearchForShops()
    {
        $request = new \nuffy\dao365\request\FindShops(2610, "Islevdalvej 148");
        $response = self::$client->request($request);
        $this->assertInstanceOf(\nuffy\dao365\response\ShopSearchResult::class, $response);
    }

    public function testCanGetShopDetails()
    {
        $response = self::$client->findShop(95784);
        $this->assertInstanceOf(\nuffy\dao365\response\ShopSearchResult::class, $response);
    }

    public function testCanGetTrackingStatusCodes()
    {
        $response = self::$client->getTrackingStatusCodes();
        $this->assertInstanceOf(\nuffy\dao365\response\TrackingStatusCodes::class, $response);
        $this->assertIsIterable($response->Direct);
        $this->assertIsIterable($response->Shop);
        $this->assertIsIterable($response->Nightly);
        // $this->assertCount($response->Codes, 3);
    }

    public function testCanGetErrorCodes()
    {
        $response = self::$client->getErrorCodes();
        $this->assertInstanceOf(\nuffy\dao365\response\ErrorCodes::class, $response);
        $this->assertEquals("100", $response->Codes[0]->Code);
    }

    public function testCanTrackNTracePackage()
    {
        $this->assertTrue(true);
    }

}