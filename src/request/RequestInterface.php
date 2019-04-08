<?php
namespace nuffy\dao365\request;

interface RequestInterface
{
    public function getQueryData() : array;
}