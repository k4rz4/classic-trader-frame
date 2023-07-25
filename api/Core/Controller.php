<?php

namespace App\ClassicTrader\Core;

use App\ClassicTrader\Core\Logger;
use App\ClassicTrader\Http\Response;

abstract class Controller
{
    protected Logger $logger;
    protected Response $response;
    protected Database $db;

    public function __construct(Logger $logger, Response $response, Database $db)
    {
        $this->logger = $logger;
        $this->response = $response;
        $this->db = $db;

        $this->initialize();
    }

    protected function initialize()
    {
        // This method can be overridden by subclasses
    }

    protected function jsonResponse(array $data, int $statusCode = 200): Response
    {
        $this->response = $this->response->withStatus($statusCode)
            ->withHeader('Content-Type', 'application/json')
            ->withBody(json_encode(['status' => $statusCode, 'data' => $data]));

        return $this->response;
    }

    protected function jsonSuccess($data): Response
    {
        return $this->jsonResponse($data, 200);
    }

    protected function jsonError($message, $statusCode = 500): Response
    {
        return $this->jsonResponse(['message' => $message], $statusCode);
    }

    public function handleException(\Exception $e): void
    {
        $this->logger->error('Uncaught exception: ' . $e->getMessage());
        $this->jsonError('An unexpected error occurred', 500);
    }
}