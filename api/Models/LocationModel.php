<?php
namespace App\ClassicTrader\Models;

use App\ClassicTrader\Core\Model;

class LocationModel extends Model
{
    public $postalCode;
    public $city;
    public $state;
    public $street;
    public $countryCode;

    public function __construct($database)
    {
        parent::__construct($database);
    }

    public function mapDataToObject(array $data)
    {
        $this->postalCode = $data['postalCode'] ?? null;
        $this->city = $data['city'] ?? null;
        $this->state = $data['state'] ?? null;
        $this->street = $data['street'] ?? null;
        $this->countryCode = $data['countryCode'] ?? null;
        
        return $this;
    }

}
