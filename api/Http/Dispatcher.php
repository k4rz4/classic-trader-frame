<?php
namespace App\ClassicTrader\Http;

class Dispatcher
{
    private Request $request;

    public function dispatch(): void
    {
        $this->request = new Request();
        $router = new Router($this->request);

        $registerRoutes = include ROOT . 'routes.php';
        $registerRoutes($router);

        $router->resolve();
    }
}

