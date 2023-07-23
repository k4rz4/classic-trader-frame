<?php

try {
    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *");

    require __DIR__ . '/../src/core.php';

    define('WEBROOT', str_replace("public/index.php", "", $_SERVER["SCRIPT_NAME"]));
    define('ROOT', str_replace("public/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

    $request = new App\ClassicTrader\Http\Request();

    $dispatcher = new App\ClassicTrader\Http\Dispatcher($request, $database);
    $dispatcher->dispatch();

    set_exception_handler([$controller, 'handleException']);
    
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(["status" => 500, "Error" => $e->getMessage()]);
    die();
}