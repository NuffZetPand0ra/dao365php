<?php
namespace nuffy\dao365\response;

class TrackingStatusCodes implements ResponseInterface
{
    public $Direct;
    public $Shop;
    public $Nightly;

    function __construct(\stdClass $response)
    {
        $response = (array)$response;
        foreach($response as &$type){
            array_walk($type, [$this, "formatStatus"]);
            usort($type, [$this, "sortStatus"]);
        }
        $this->Direct = $response["direkte"];
        $this->Shop = $response["pakkeshop"];
        $this->Nightly = $response["natxpress"];
    }

    private function formatStatus(\stdClass &$status)
    {
        $status = (object)["Code"=>$status->haendelse, "Description"=>$status->beskrivelse];
        return $status;
    }

    private function sortStatus(\stdClass $status_one, \stdClass $status_two)
    {
        return $status_one->Code > $status_two->Code ? 1 : -1;
    }
}