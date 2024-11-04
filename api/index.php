<?php

// Define the base path
define('BASE_PATH', realpath(dirname(__FILE__) . '/../'));

// Autoload or require necessary files
require_once BASE_PATH . '/app/core/init.php';

// Simple routing logic
$url = $_GET['url'] ?? '';
$url = explode('/', trim($url, '/'));

// show($url);

$controllerName = ucfirst($url[0] ?? 'Home') . 'Controller';
$methodName = $url[1] ?? 'index';

$controllerFile = BASE_PATH . '/api/controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName();

    if (method_exists($controller, $methodName)) {
        $controller->$methodName();
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Method not found']);
    }
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Controller not found']);
}
