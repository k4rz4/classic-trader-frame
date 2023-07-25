<?php
namespace App\ClassicTrader\Http;

class Request implements IRequest
{
    private array $serverParams;
    private array $queryParams;
    private array $headers;
    private string $method;
    private string $uri;
    private $body;

    private array $params = [];

    public function __construct()
    {
        $this->serverParams = $_SERVER;
        $this->queryParams = $_GET;
        $this->headers = getallheaders();
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->body = $this->getParsedBody();
    }

    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    public function getParams(): array
    {
        return $this->params;
    }
    
    public function getParsedBody()
    {
        if ($this->method === 'POST') {
            $body = file_get_contents('php://input');
            return json_decode($body, true);
        }

        return null;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    //Nnot working currently rework at some point
    public function getQueryParams(): array
    {
        return $this->queryParams;
    }
}
