<?php
include "vendor/autoload.php";

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing;

$request = Request::createFromGlobals();
$routes = include __DIR__.'/Config/routes.php';

$dispatcher = new EventDispatcher();
$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$kernel = new HttpKernel($dispatcher, $controllerResolver, new RequestStack(), $argumentResolver);

try{
    $context = new Routing\RequestContext();
    $context->fromRequest($request);
    $matcher = new Routing\Matcher\UrlMatcher($routes, $context);
    $request->attributes->add($matcher->match($request->getPathInfo()));
    $response = $kernel->handle($request);
}catch(Exception $e){
    $response = new Response('<p>Not found</p>', Response::HTTP_NOT_FOUND);
}

$response->send();


$kernel->terminate($request, $response);