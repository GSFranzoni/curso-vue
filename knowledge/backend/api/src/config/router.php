<?php 

header("Content-type: application/json");

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$app->get('/users', function (Request $request, Response $response, $args) {
    $response->getBody()->write(UserController::getAll());
    return $response;
});

$app->get('/users/{id}', function (Request $request, Response $response, $args) {
    $response->getBody()->write(UserController::get($args['id']));
    return $response;
});

$app->get('/users/{id}/delete', function (Request $request, Response $response, $args) {
    $response->getBody()->write(UserController::delete($args['id']));
    return $response;
});

$app->run();
