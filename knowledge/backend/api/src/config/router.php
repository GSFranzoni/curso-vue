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

$app->delete('/users/{id}', function (Request $request, Response $response, $args) {
    try {
        UserController::delete($args['id']);
        $message = 'Registro deletado com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $message = $ex->getMessage();
        $status = 500;
    }
    $response->getBody()->write(json_encode(Array('status' => $status, 'message' => $message)));
    return $response;
});

$app->get('/categories', function (Request $request, Response $response, $args) {
    $response->getBody()->write(CategoryController::getAll());
    return $response;
});

$app->get('/categories/tree', function (Request $request, Response $response, $args) {
    $response->getBody()->write(CategoryController::getTree());
    return $response;
});

$app->post('/category', function (Request $request, Response $response, $args) {
    try {
        CategoryController::insert(Category::fromJson($request->getBody()));
        $message = 'Inserido com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $message = $ex->getMessage();
        $status = 500;
    }
    $response->getBody()->write(json_encode(array('message' => $message, 'status' => $status)));
    return $response;
});

$app->delete('/categories/{id}', function (Request $request, Response $response, $args) {
    try {
        CategoryController::delete($args['id']);
        $message = 'Registro deletado com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $message = $ex->getMessage();
        $status = 500;
    }
    $response->getBody()->write(json_encode(Array('status' => $status, 'message' => $message)));
    return $response;
});

$app->run();
