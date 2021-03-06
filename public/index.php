<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require 'db.php';
$app = AppFactory::create();
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    	$name = $request->getAttribute('name');
	$response->getBody()->write("Hello , $name ");
    return $response;
});
require 'myfrigo.php';
$app->run();
