<?php
namespace nuffy\dao365\response;

use nuffy\dao365\Shop;

class ShopSearchResult implements ResponseInterface
{
    public $Shops = [];
    public $StartingPoint;

    function __construct(\stdClass $response)
    {
        foreach($response->pakkeshops as $shop){
            $this->Shops[] = new Shop($shop);
        }
        $this->StartingPoint = [$response->udgangspunkt->latitude, $response->udgangspunkt->latitude];
    }
}