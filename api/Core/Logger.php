<?php

namespace App\ClassicTrader\Core;

use Monolog\Logger as Monolog;
use Monolog\Level; 
use Monolog\Handler\StreamHandler;

class Logger 
{
    private Monolog $logger;

    public function __construct(string $logFile, Level $logLevel) 
    {
        $this->logger = new Monolog('my_logger');
        $this->logger->pushHandler(new StreamHandler($logFile, $logLevel));
    }

    public function info(string $message) 
    {
        $this->logger->info($message);
    }

    public function error(string $message) 
    {
        $this->logger->error($message);
    }

    public function warning(string $message) 
    {
        $this->logger->warning($message);
    }

    public function notice(string $message) 
    {
        $this->logger->notice($message);
    }

    public function critical(string $message) 
    {
        $this->logger->critical($message);
    }

}
