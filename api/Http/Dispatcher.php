<?php

namespace App\ClassicTrader\Http;

use Exception;
use App\ClassicTrader\Core\ControllerFactory;

class Dispatcher
{
    private Request $request;
    private Router $router;
    private ControllerFactory $controllerFactory;

    public function __construct(Request $request, Router $router, ControllerFactory $controllerFactory)
    {
        $this->request = $request;
        $this->router = $router;
        $this->controllerFactory = $controllerFactory;
    }

    public function dispatch(): Response
    {
        $registerRoutes = include ROOT . 'src/routes.php'; // Updated path
        $registerRoutes($this->router);

        $route = $this->router->resolve();

        if ($route === null) {
            throw new Exception('No matching route found');
        }

        list($controller, $method) = explode('@', $route);

        $controllerInstance = $this->controllerFactory->create($controller);
        return $controllerInstance->$method($this->request);
    
    }

}