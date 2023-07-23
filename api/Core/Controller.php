<?php

namespace App\ClassicTrader\Core;

use Exception;

class Controller
{
    protected $statusCode = 200;

    public function __construct() {
        // Empty constructor for future use
    }

    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function jsonResponse(array $data, int $statusCode = null)
    {
        header('Content-Type: application/json');

        if ($statusCode) {
            $this->setStatusCode($statusCode);
        }

        http_response_code($this->getStatusCode());

        echo json_encode(['status' => $this->getStatusCode(), 'data' => $data]);

        exit();
    }

    public function jsonSuccess($data)
    {
        return $this->jsonResponse($data, 200);
    }

    public function jsonError($message, $statusCode = 500)
    {
        return $this->jsonResponse(['message' => $message], $statusCode);
    }


    public function handleException(\Exception $e) 
    {
        $this->logger->error('Uncaught exception: ' . $e->getMessage());
        $this->jsonError(500, 'An unexpected error occurred');
    }
}