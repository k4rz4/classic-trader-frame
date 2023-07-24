<?php

namespace App\ClassicTrader\Core;

use App\ClassicTrader\Core\Logger;
use App\ClassicTrader\Http\Response;

class ControllerFactory
{
    private Logger $logger;
    private Response $response;

    public function __construct(Logger $logger, Response $response)
    {
        $this->logger = $logger;
        $this->response = $response;
    }

    public function create(string $controllerClass)
    {
        return new $controllerClass($this->logger, $this->response);
    }
}