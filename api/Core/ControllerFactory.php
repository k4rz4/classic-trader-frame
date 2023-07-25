<?php

namespace App\ClassicTrader\Core;

use App\ClassicTrader\Core\Database;
use App\ClassicTrader\Core\Logger;
use App\ClassicTrader\Http\Response;

class ControllerFactory
{
    private Logger $logger;
    private Response $response;
    private Database $db;
    
    public function __construct(Logger $logger, Response $response, Database $database)
    {
        $this->logger = $logger;
        $this->response = $response;
        $this->db = $database;
    }

    public function create(string $controllerClass)
    {
        return new $controllerClass($this->logger, $this->response, $this->db);
    }
}