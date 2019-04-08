<?php
namespace nuffy\dao365\response;

class ErrorCodes implements ResponseInterface
{
    public $Codes;

    function __construct(\stdClass $response)
    {
        $this->Codes = (array)$response;
        array_walk($this->Codes, [$this, "formatStatus"]);
        usort($this->Codes, [$this, "sortStatus"]);
    }

    private function formatStatus(\stdClass &$status)
    {
        $status = (object)["Code"=>$status->fejlkode, "Description"=>$status->fejltekst];
        return $status;
    }

    private function sortStatus(\stdClass $status_one, \stdClass $status_two)
    {
        return $status_one->Code > $status_two->Code ? 1 : -1;
    }
}