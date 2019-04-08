<?php
namespace nuffy\dao365;

class Shop
{
    public $ShopId;
    public $Name;
    public $Address;
    public $Zip;
    public $City;
    public $Outsorting;
    public $Coordinates;
    public $Distance;
    public $OpeningHours;

    function __construct($data)
    {
        $this->ShopId = $data->shopId;
        $this->Name = $data->navn;
        $this->Address = $data->adresse;
        $this->Zip = $data->postnr;
        $this->City = $data->bynavn;
        $this->Outsorting = $data->udsortering;
        $this->Coordinates = [$data->latitude, $data->longitude];
        $this->Distance = $data->afstand;
        $this->OpeningHours = $data->aabningstider;
    }
}