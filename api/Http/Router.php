<?php

namespace App\ClassicTrader\Http;

use Exception;
use App\ClassicTrader\Http\Request;

class Router
{
    private Request $request;
    private array $routes = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get(string $route, string $controllerAction)
    {
        $this->routes['GET'][$this->formatRoute($route)] = $controllerAction;
    }

    public function post(string $route, string $controllerAction)
    {
        $this->routes['POST'][$this->formatRoute($route)] = $controllerAction;
    }

    // // Add other methods for different HTTP methods (e.g., put, delete, etc.)...

    public function resolve()
    {
        $method = $this->request->getMethod();
        $uri = $this->request->getUri();

        foreach ($this->routes[$method] as $route => $controllerAction) {
            $pattern = preg_replace('#\{([a-z]+)\}#', '(?<$1>[^/]+)', $route);
            if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $this->request->setParams($params);
                return $controllerAction;
            }
        }

        // Handle the 404 error 
        return null;
    }

    private function formatRoute(string $route): string
    {
        return rtrim($route, '/');
    }
}
