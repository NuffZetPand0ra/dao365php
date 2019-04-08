<?php
namespace nuffy\dao365\request;

use nuffy\dao365\{Receiver, DaoException};
use Carbon\Carbon;

class CreateDirectOrder implements RequestInterface
{
    /** @var Receiver Receiver of the direct order. */
    public $Receiver;

    /** @var \DateTime|null Delivery date of the order. */
    public $DeliveryDate;

    /** @var int Weight of the package in grams. */
    public $Weight;

    /** @var array Dimensions of the package. Must have three (3) unindexed rows: `w,h,d` in cm. */
    public $Dimensions;

    /** @var string Order id of then contents of the package. */
    public $OrderId;

    /** @var string|null Sender id. Only neccesary if you want to send with a different sender id than your default. */
    public $SenderId;

    /** @var bool To be delivered same day. Overrides DeliveryDate. */
    public $SameDay;

    /** @var bool Is this a test order? If so, no barcode will be made, and no new orderlines will be created. */
    public $Test;

    function __construct(Receiver $receiver, ?\DateTime $delivery_date, int $weight, array $dimensions, string $order_id, ?string $sender_id = null, bool $same_day = false, bool $test = false)
    {
        $this->Receiver = $receiver;
        $this->DeliveryDate = $delivery_date;
        $this->Weight = $weight;
        $this->Dimensions = $dimensions;
        $this->OrderId = $order_id;
        $this->SenderId = $sender_id;
        $this->SameDay = $same_day;
        $this->Test = $test;
    }

    public function getQueryData() : array
    {
        $return = [
            "postnr"    => $this->Receiver->Zip,
            "adresse"   => $this->Receiver->Address,
            "navn"      => $this->Receiver->Name,
            "mobil"     => $this->Receiver->Phone,
            "email"     => $this->Receiver->Email,
            "vaegt"     => $this->Weight,
            "l"         => $this->Dimensions[0],
            "h"         => $this->Dimensions[1],
            "b"         => $this->Dimensions[2],
            "faktura"   => $this->OrderId,
        ];

        if($this->DeliveryDate) $return["dato"] = $this->DeliveryDate->format("Y-m-d");
        elseif($this->SameDay) $return["sameday"] = 1;
        else throw new DaoException("You must have either delivery date or sameday defined.");

        if($this->SenderId) $return["afsenderid"] = $this->SenderId;
        if($this->Test) $return["test"] = 1;

        return $return;
    }
}