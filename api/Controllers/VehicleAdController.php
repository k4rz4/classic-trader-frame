<?php
namespace App\ClassicTrader\Controllers;

use App\ClassicTrader\Core\Controller;
use App\ClassicTrader\Core\Logger;
use App\ClassicTrader\Core\Validator;
use App\ClassicTrader\Core\Database;
use App\ClassicTrader\Http\Response;
use App\ClassicTrader\Http\Request;
use App\ClassicTrader\Services\VehicleAdService;


class VehicleAdController extends Controller 
{
    private $vehicleAdService;
    private $validator;

    public function __construct(Logger $logger, Response $response, Database $db)
    {
        parent::__construct($logger, $response, $db);

        $this->vehicleAdService = new VehicleAdService($db, $logger);
        $this->validator = new Validator();
    }
 
    public function getVehicleAdDetails(Request $request)
    {
        $this->logger->info("getVehicleAdDetails method called"); 

        try {

            $id = $request->getParams()['id'];
            $this->validator->validateInteger($id);

            $vehicleAdDetails = $this->vehicleAdService->getVehicleAdDetails($id);

            return $this->jsonSuccess($vehicleAdDetails);

        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return $this->jsonError($e->getMessage(), 500);
        }
        
    }

    public function sendMessage(Request $request)
    {
        $request->getParsedBody();
        
    }
}