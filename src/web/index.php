<?php

require('../../vendor/autoload.php');

use App\controllers\CargoController;
use App\controllers\TransportController;
use App\routers\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('../../config');
$dotenv->load();

$router = new Router();
$router::setDefault('/', function () {
    require('../../views/transport.php');
});
$router::set('/api/transports', function () {
    $controller = new TransportController($_SERVER['REQUEST_METHOD']);
    $controller->handleRequest();
});
$router::set('/api/cargos', function () {
    $controller = new CargoController($_SERVER['REQUEST_METHOD']);
    $controller->handleRequest();
});

$router->dispatch($_SERVER['REQUEST_URI']);