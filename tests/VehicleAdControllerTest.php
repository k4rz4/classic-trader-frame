<?php

use PHPUnit\Framework\TestCase;
use App\ClassicTrader\Controllers\VehicleAdController;
use App\ClassicTrader\Services\VehicleAdService;
use App\ClassicTrader\Http\Request;
use App\ClassicTrader\Core\Logger;
use App\ClassicTrader\Http\Response;
use App\ClassicTrader\Core\Database;

class VehicleAdControllerTest extends TestCase
{
    private $vehicleAdController;
    private $vehicleAdService;
    private $logger;
    private $response;
    private $database;

    protected function setUp(): void
    {
        $this->vehicleAdService = $this->createMock(VehicleAdService::class);
        $this->logger = $this->createMock(Logger::class);
        $this->response = $this->createMock(Response::class);
        $this->database = $this->createMock(Database::class);

        //need to mock response object
        $this->response->method('withStatus')->willReturnCallback(function ($statusCode) {
            $response = new Response();
            return $response->withStatus($statusCode);
        });
        $this->response->method('withHeader')->willReturnCallback(function ($name, $value) {
            $response = new Response();
            return $response->withHeader($name, $value);
        });
        $this->response->method('withBody')->willReturnCallback(function ($body) {
            $response = new Response();
            return $response->withBody($body);
        });

        $this->vehicleAdController = new VehicleAdController($this->logger, $this->response, $this->database);
    }

    public function testGetVehicleAdDetails()
    {
        $request = $this->createMock(Request::class);
        $request->method('getParams')->willReturn(['id' => 331124]);
        
        $response = $this->vehicleAdController->getVehicleAdDetails($request);
        $responseData = json_decode($response->getBody(), true)['data'];

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('id', $responseData);
        $this->assertEquals(331124, $responseData['id']);
        $this->assertArrayHasKey('uid', $responseData);
        $this->assertEquals('911SSWTSWB', $responseData['uid']);
    }

    public function testSendMessage()
    {
        $request = $this->createMock(Request::class);
        $request->method('getParsedBody')->willReturn([
            'id' => 331124, 
            'message' => 'Test message',
            'subject' => 'Te3st subject',
            'first_name' => 'Ok',
            'last_name' => 'let\'s go',
            'email' => 'test@email.com'
        ]);

        $response = $this->vehicleAdController->sendMessage($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['Message sent'], json_decode($response->getBody(), true)['data']);
    }
    
    public function testSaveBookmark()
    {
        $request = $this->createMock(Request::class);
        $request->method('getParams')->willReturn(['id' => 331124]);
    
        $response = $this->vehicleAdController->saveBookmark($request);
    
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['Bookmark saved'], json_decode($response->getBody(), true)['data']);
    }
}
