<?php

namespace App\ClassicTrader\Core;

use Monolog\Logger as Monolog;
use Monolog\Handler\StreamHandler;

class Logger 
{
    private $logger;

    public function __construct() 
    {
        $this->logger = new Monolog('my_logger');
        $this->logger->pushHandler(new StreamHandler(__DIR__.'/app.log', Logger::DEBUG));
    }

    public function info($message) 
    {
        $this->logger->info($message);
    }

    public function error($message) 
    {
        $this->logger->error($message);
    }

    // You can add other methods for different log levels like warning, notice, etc.
}