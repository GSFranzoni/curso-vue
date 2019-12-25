<?php 

header("Content-type: application/json");

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get('/users/{id}', function (Request $request, Response $response, $args) {
    $response->getBody()->write(json_encode(
        array('id' => $args['id'], 'name' => $_GET['name'])
    ));
    return $response;
});

$app->run();
