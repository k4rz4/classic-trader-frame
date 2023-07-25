<?php

require __DIR__ . '/../../vendor/autoload.php';

use App\ClassicTrader\Core\Database;
use App\ClassicTrader\Core\Logger;
use App\ClassicTrader\Core\ControllerFactory;
use App\ClassicTrader\Http\Router;
use App\ClassicTrader\Http\Dispatcher;
use App\ClassicTrader\Http\Request;
use App\ClassicTrader\Http\Response;
use Monolog\Level;

define('CONFIG', parse_ini_file('../config/config.ini'));

//maybe this belongs better in Database class and just pass config 
$pdo = new PDO(
    'mysql:host=' . CONFIG['db_host'] . 
    ';dbname=' . CONFIG['db_database'],
    CONFIG['db_user'],
    CONFIG['db_password']
);
$database = new Database($pdo);

$logger = new Logger(__DIR__.'/../../logs/app.log', Level::Debug);

$request = new Request();
$response = new Response();
$controllerFactory = new ControllerFactory($logger, $response, $database);
$router = new Router($request);
$dispatcher = new Dispatcher($request, $router, $controllerFactory);

return compact('database', 'logger', 'request', 'response','dispatcher');
