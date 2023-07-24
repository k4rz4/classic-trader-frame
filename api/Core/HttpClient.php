<?php

namespace App\ClassicTrader\Core;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use App\ClassicTrader\Http\Response;
use App\ClassicTrader\Core\Logger;

class HttpClient
{
    private Client $client;
    protected Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->client = new Client();
        $this->logger = $logger;
    }

    public function get(string $url, array $headers = []): Response
{
    try {
        $httpResponse = $this->client->request('GET', $url, [
            'headers' => $headers
        ]);

        $body = $httpResponse->getBody()->getContents();
        $statusCode = $httpResponse->getStatusCode();
        $headers = $httpResponse->getHeaders();
        // Convert headers to associative array
        $headersAssoc = [];
        foreach ($headers as $name => $values) {
            $headersAssoc[$name] = implode(', ', $values);
        }

        return new Response($statusCode, $body, $headersAssoc);
    } catch (GuzzleException $e) {
        // Handle the exception 
        return new Response(500, $e->getMessage());
    }
}

}