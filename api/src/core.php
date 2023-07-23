<?php

require __DIR__ . '/../vendor/autoload.php';

use App\ClassicTrader\Core\Database;

define('CONFIG', parse_ini_file('../config/config.ini'));

$database = new Database(
    CONFIG['db_host'],
    CONFIG['db_database'],
    CONFIG['db_user'],
    CONFIG['db_password']
);

return compact('database');