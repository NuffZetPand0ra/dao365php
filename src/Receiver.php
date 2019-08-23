<?php
namespace nuffy\dao365;

/**
 * Receivers of a DAO 365 orders
 */
class Receiver
{
    /** @var string Full name of the recipient. */
    public $Name;

    /** @var string Full address of the recipient. */
    public $Address;

    /** @var string Zip code of the recipient. Can include ISO 3166-1 Alpha 2 country codes (e.g. DK4000) */
    public $Zip;

    /** @var int|null The recipients danish phone number, if applicaple. */
    public $Phone;

    /** @var string|null Email address of the recipient. */
    public $Email;

    function __construct(string $name, string $address, string $zip, ?int $phone = null, ?string $email = null)
    {
        $this->Name = $name;
        $this->Address = $address;
        $this->Zip = $zip;
        $this->Phone = $phone;
        $this->Email = $email;
    }
}