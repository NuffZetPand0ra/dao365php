<?php
namespace nuffy\dao365\request;

use nuffy\dao365\{DaoException};
use Carbon\Carbon;

class FindShops implements RequestInterface
{
    public $Zip;
    public $Address;
    public $Count;

    function __construct(int $zip, string $address, int $count = 10)
    {
        $this->Zip = $zip;
        $this->Address = $address;
        $this->Count = $count;
    }

    public function getQueryData() : array
    {
        $return = [
            "postnr"    => $this->Zip,
            "adresse"   => $this->Address,
            "antal"     => $this->Count
        ];
        return $return;
    }
}