<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Controllers\IndexController;
use Controllers\CartController;

$routes = new RouteCollection();

$routes->add('index', new Route('/',['_controller' => IndexController::class, '_action' => 'index'] ) );
$routes->add('cart', new Route('/cart',['_controller' => CartController::class, '_action' => 'index'] ));

return $routes;