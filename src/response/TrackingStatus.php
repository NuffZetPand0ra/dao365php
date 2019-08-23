<?php
namespace nuffy\dao365\response;

use nuffy\dao365\Receiver;

class TrackingStatus implements ResponseInterface
{
    public $Barcode;
    public $PackageType;
    public $ETA;
    public $Sender;
    public $Receiver;
    public $History;

    function __construct(\stdClass $response)
    {
        $this->Barcode = $response->stregkode;
        $this->PackageType = $response->pakketype;
        $this->ETA = $response->eta;
        $this->Sender = $response->afsender;
        $zip = explode(" ", $response->modtager->post)[0];
        $this->Receiver = new Receiver($response->modtager->navn, $response->modtager->adresse, $zip);
        $this->History = $response->haendelser;
    }
}