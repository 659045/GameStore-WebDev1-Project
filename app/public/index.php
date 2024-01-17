<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require __DIR__ . '/../patternRouter.php';
session_start();

$uri = trim($_SERVER['REQUEST_URI'], '/');

$router = new PatternRouter();

try {
    $router->route($uri);
} catch (Exception $e) {
    http_response_code(500);
    echo $e;
    die();
}