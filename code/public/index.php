<?php

require_once "../vendor/autoload.php";
require_once "../generated-conf/config.php";

ini_set("display_errors", 1);

$env = new \Symfony\Component\Dotenv\Dotenv();
$env->load(__DIR__ . "/../.env");

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r){
    $r->addRoute('POST', '/addImages', \Vegans\Controllers\Images\AddImages::class);
    $r->addRoute('GET', '/deleteImage/{id:[a-zA-Z-0-9]+}', \Vegans\Controllers\Images\DeleteImage::class);
    $r->addRoute('GET', '/', \Vegans\Controllers\Home\Index::class);

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if(false !== $pos = strpos($uri, '?')){
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch($routeInfo[0]){
    case FastRoute\Dispatcher::NOT_FOUND:
        $httpResponseCode = 404;
        header("HTTP/1.0 404 Not Found");
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        header("HTTP/1.0 405 Method Not Allowed");
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        call_user_func_array([new $handler, 'execute'], $vars);
        break;
}