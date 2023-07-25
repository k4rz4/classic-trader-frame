<?php

namespace App\ClassicTrader\Services;

use App\ClassicTrader\Core\Database;
use App\ClassicTrader\Core\Service;
use App\ClassicTrader\Core\Logger;
use App\ClassicTrader\Core\HttpClient;
use App\ClassicTrader\Models\VehicleAdModel;
use App\ClassicTrader\Helper\Helper;

class VehicleAdService extends Service
{
    private $vehicleAdModel;
    private $client;

    public function __construct(Database $database, Logger $logger)
    {   
        parent::__construct($database, $logger);

        $this->vehicleAdModel = new VehicleAdModel($database);
        $this->initialize();
    }

    protected function initialize()
    {
        $this->client = new HttpClient($this->logger);
    }

   
    public function getVehicleAdDetails($id): array
    {
        $adModel = $this->callCTExternalApi($id);

        return Helper::objectToArray($adModel);
    }

    public function callCTExternalApi ($id): VehicleAdModel {
        //url string should be in config 
        $response = $this->client->get("https://www.classic-trader.com/api/vehicle-ad/{$id}.json");
                
        if ($response->getStatusCode() !== 200) {
            throw new \Exception("Failed to get vehicle ad details: " . $response->getBody());
        }
        $data = json_decode($response->getBody(), true)['data'];

        return $this->vehicleAdModel->getVehicleAdDetails($data);
    }
}
