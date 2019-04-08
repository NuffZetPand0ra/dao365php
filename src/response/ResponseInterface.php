<?php
namespace nuffy\dao365\response;

interface ResponseInterface
{
    public function __construct(\stdClass $response);
}