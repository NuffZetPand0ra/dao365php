<?php
namespace nuffy\dao365\request;

use nuffy\dao365\{DaoException};
use Carbon\Carbon;

class TrackOrder implements RequestInterface
{
    public $Barcode;

    function __construct(string $barcode)
    {
        $this->Barcode = $barcode;
    }

    public function getQueryData() : array
    {
        $return = [
            "stregkode" => $this->Barcode
        ];
        return $return;
    }
}