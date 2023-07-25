<?php

namespace App\ClassicTrader\Models;

use App\ClassicTrader\Core\Model;


class ContactModel extends Model
{
    public $firstName;
    public $lastName;
    public $phone;
    public $salutation;
    public $companyName;
    public $email;

    public function __construct($database)
    {
        parent::__construct($database);
    }

    public function mapDataToObject(array $data)
    {
        $this->firstName = $data['firstName'] ?? null;
        $this->lastName = $data['lastName'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->salutation = $data['salutation'] ?? null;
        $this->companyName = $data['companyName'] ?? null;
        $this->email = $data['email'] ?? null;

        return $this;
    }
}
