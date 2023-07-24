<?php

try {
    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *");

    $core = require __DIR__ . '/../src/core.php';

    define('WEBROOT', str_replace("public/index.php", "", $_SERVER["SCRIPT_NAME"]));
    define('ROOT', str_replace("public/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

    $response = $dispatcher->dispatch();
    $response->send();

} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(["status" => 500, "Error" => $e->getMessage()]);
    die();
}