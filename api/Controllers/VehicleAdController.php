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
        $this->logger->info("sendMessage method called"); 

        $req = $request->getParsedBody();

        if (!isset($req['subject']) || trim($req['subject']) == '') {
        
            $this->logger->error('subject field is required');
            return $this->jsonError('subject field is required', 500);
        }
        if (!isset($req['first_name']) || trim($req['first_name']) == '') {
        
            $this->logger->error('first_name field is required');
            return $this->jsonError('first_name field is required', 500);
        }
        if (!isset($req['last_name']) || trim($req['last_name']) == '') {
        
            $this->logger->error('last_name field is required');
            return $this->jsonError('last_name field is required', 500);
        }
        if (!isset($req['email']) || trim($req['email']) == '') {
        
            $this->logger->error('email field is required');
            return $this->jsonError('email field is required', 500);
        }
        if (!isset($req['message']) || trim($req['message']) == '') {
        
            $this->logger->error('message field is required');
            return $this->jsonError('message field is required', 500);
        }


        try {

            $this->validator->validateEmail($req['email']);

            $this->vehicleAdService->sendMessage($req);

            return $this->jsonSuccess('Message sent');

        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return $this->jsonError($e->getMessage(), 500);
        }

    }

    public function saveBookmark(Request $request)
    {
        $this->logger->info("saveBookmark method called"); 
        //$auth->user;
        try {

            $id = $request->getParams()['id'];
            $this->validator->validateInteger($id);

            //pass auth->user so we can save to db 
            $bookmark = $this->vehicleAdService->saveBookmark($id);

            return $this->jsonSuccess("Bookmark saved");

        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return $this->jsonError($e->getMessage(), 500);
        }
    }
}