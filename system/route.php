<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {

    $route->addRoute('GET', '/register', 'register/registerUser');

    $route->addRoute('GET', '/register2[/{id}[/{name}]]', 'register/registerUserTwo');

    $route->addRoute('GET', '/login', 'login/loginUser');

    $route->addRoute('GET', '/', 'index/home');


});


$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {

    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);


switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        die('NOT_FOUND');
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        die('Not Allowed');
        break;
    case FastRoute\Dispatcher::FOUND:

        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        list($class, $method) = explode('/', $handler, 2);

        call_user_func_array([new $class, $method], $vars);
        break;

}