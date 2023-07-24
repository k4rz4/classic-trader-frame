<?php
namespace App\ClassicTrader\Controllers;

use App\ClassicTrader\Core\Controller;
use App\ClassicTrader\Http\Request;
use App\ClassicTrader\Core\HttpClient;

class VehicleAdController extends Controller 
{
    public function getVehicleAdDetails(Request $request)
    {
        $this->logger->info("getVehicleAdDetails method called"); 
        $client = new HttpClient($this->logger);
        $response = $client->get("https://www.classic-trader.com/api/vehicle-ad/" . $request->getParams()['id'] . ".json");

        if ($response->getStatusCode() !== 200) {
            return $this->jsonError($response->getBody(), 500);
        }

        $data = json_decode($response->getBody(), true);

        return $this->jsonSuccess($data);
    }
}