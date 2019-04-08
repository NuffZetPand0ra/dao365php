<?php
namespace nuffy\dao365\request;

use nuffy\dao365\{Receiver, DaoException};
use Carbon\Carbon;

class CreateShopOrder extends CreateDirectOrder
{
    public $ShopId;

    function __construct(?int $shop_id = null, Receiver $receiver, ?\DateTime $delivery_date, int $weight, array $dimensions, string $order_id, ?string $sender_id = null, bool $test = false)
    {
        $this->ShopId = $shop_id;
        parent::__construct($receiver, $delivery_date, $weight, $dimensions, $order_id, $sender_id, false, $test);
    }

    public function getQueryData() : array
    {
        return parent::getQueryData()+["shopid"=>$this->ShopId ?? "0"];
    }
}