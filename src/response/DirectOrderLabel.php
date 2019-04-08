<?php
namespace nuffy\dao365\response;

class DirectOrderLabel implements ResponseInterface
{
    public $Barcode;
    public $LabelText1;
    public $LabelText2;
    public $LabelText3;
    public $Outsorting;
    public $ETA;

    function __construct(\stdClass $response)
    {
        $this->Barcode = $response->stregkode;
        $this->LabelText1 = $response->labelTekst1;
        $this->LabelText2 = $response->labelTekst2;
        $this->LabelText3 = $response->labelTekst3;
        $this->Outsorting = $response->udsortering;
        $this->ETA = new \DateTime($response->ETA);
    }
}