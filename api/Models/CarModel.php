<?php

namespace App\ClassicTrader\Models;

use App\ClassicTrader\Core\Model;

class CarModel extends Model
{
    public $make;
    public $model;
    public $specification;
    public $body;
    public $bodyDetailed;


    public function __construct($database)
    {
        parent::__construct($database);
    }

    public function mapDataToObject(array $data)
    {
        $this->make = $data['make'] ?? null;
        $this->model = $data['model'] ?? null;
        $this->specification = $data['specification'] ?? null;
        $this->body = $data['body'] ?? null;
        $this->bodyDetailed = $data['bodyDetailed'] ?? null;

        return $this;
    }
}
