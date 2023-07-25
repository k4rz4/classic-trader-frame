<?php
namespace App\ClassicTrader\Core;

use App\ClassicTrader\Core\Database;
use App\ClassicTrader\Core\Logger;

abstract class Service {
    protected Database $db;
    protected Logger $logger;

    public function __construct(Database $database, Logger $logger) {
        $this->db = $database;
        $this->logger = $logger;
    }
}