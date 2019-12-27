<?php 

header("Content-type: application/json");

use Slim\Psr7\Response as RespondeModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$authorizationMiddleware = function (Request $request, RequestHandler $handler) {
    $response = $handler->handle($request);
    $authorization = $request->getHeader('Authorization')[0];
    if(!Auth::validateToken($authorization)) {
        $response = new RespondeModel();
        $response->getBody()->write(
            json_encode(
                array(
                    'message' => 'Unauthorized',
                    'status' => 401
                )
            )
        );
    }
    return $response;
};

$app->get('/users', function (Request $request, Response $response, $args) {
    $response->getBody()->write(UserController::getAll());
    return $response;
})->add($authorizationMiddleware);;

$app->get('/users/{id}', function (Request $request, Response $response, $args) {
    $response->getBody()->write(UserController::get($args['id']));
    return $response;
})->add($authorizationMiddleware);;

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
})->add($authorizationMiddleware);;

$app->put('/users/{id}', function (Request $request, Response $response, $args) {
    try {
        UserController::update($args['id'], json_decode($request->getBody(), true));
        $message = 'Registro alterado com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $message = $ex->getMessage();
        $status = 500;
    }
    $response->getBody()->write(json_encode(array('message' => $message, 'status' => $status)));
    return $response;
})->add($authorizationMiddleware);;

$app->post('/users', function (Request $request, Response $response, $args) {
    try {
        UserController::insert(json_decode($request->getBody(), true));
        $message = 'Registro inserido com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $message = $ex->getMessage();
        $status = 500;
    }
    $response->getBody()->write(json_encode(array('message' => $message, 'status' => $status)));
    return $response;
})->add($authorizationMiddleware);;

$app->get('/categories', function (Request $request, Response $response, $args) {
    $response->getBody()->write(CategoryController::getAll());
    return $response;
})->add($authorizationMiddleware);;

$app->get('/categories/tree', function (Request $request, Response $response, $args) {
    $response->getBody()->write(CategoryController::getTree());
    return $response;
})->add($authorizationMiddleware);;

$app->post('/categories', function (Request $request, Response $response, $args) {
    try {
        CategoryController::insert(json_decode($request->getBody(), true));
        $message = 'Registro inserido com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $message = $ex->getMessage();
        $status = 500;
    }
    $response->getBody()->write(json_encode(array('message' => $message, 'status' => $status)));
    return $response;
})->add($authorizationMiddleware);;

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
})->add($authorizationMiddleware);;

$app->put('/categories/{id}', function (Request $request, Response $response, $args) {
    try {
        CategoryController::update($args['id'], json_decode($request->getBody(), true));
        $message = 'Registro alterado com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $message = $ex->getMessage();
        $status = 500;
    }
    $response->getBody()->write(json_encode(array('message' => $message, 'status' => $status)));
    return $response;
})->add($authorizationMiddleware);;

$app->get('/articles', function (Request $request, Response $response, $args) {
    $page = $_GET['page'] ?? 1;
    $response->getBody()->write(json_encode(Array(
        'data' => json_decode(ArticleController::getAllWithPagination($page)),
        'limit' => 10,
        'count' => json_decode(ArticleController::count())
    )));
    return $response;
})->add($authorizationMiddleware);;

$app->get('/articles/{id}', function (Request $request, Response $response, $args) {
    $response->getBody()->write(ArticleController::get($args['id']));
    return $response;
})->add($authorizationMiddleware);;

$app->delete('/articles/{id}', function (Request $request, Response $response, $args) {
    try {
        ArticleController::delete($args['id']);
        $message = 'Registro deletado com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $message = $ex->getMessage();
        $status = 500;
    }
    $response->getBody()->write(json_encode(Array('status' => $status, 'message' => $message)));
    return $response;
})->add($authorizationMiddleware);;

$app->post('/articles', function (Request $request, Response $response, $args) {
    try {
        ArticleController::insert(json_decode($request->getBody(), true));
        $message = 'Registro inserido com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $message = $ex->getMessage();
        $status = 500;
    }
    $response->getBody()->write(json_encode(array('message' => $message, 'status' => $status)));
    return $response;
})->add($authorizationMiddleware);;

$app->put('/articles/{id}', function (Request $request, Response $response, $args) {
    try {
        ArticleController::update($args['id'], json_decode($request->getBody(), true));
        $message = 'Registro alterado com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $message = $ex->getMessage();
        $status = 500;
    }
    $response->getBody()->write(json_encode(array('message' => $message, 'status' => $status)));
    return $response;
})->add($authorizationMiddleware);;

$app->post('/signin', function (Request $request, Response $response, $args) {
    $reqBody = json_decode($request->getBody(), true);
    try {
        $token = UserController::signin($reqBody['email'], $reqBody['password']);
        $message = "Login efetuado com sucesso!";
        $status = 200;
    }
    catch(Exception $e) {
        $message = $e->getMessage();
        $status = 400;
    }
    $res = Array('message' => $message, 'status' => $status);
    if($token)
        $res = array_merge($res, array('token'=>$token));
    $response->getBody()->write(json_encode($res));
    return $response;
});

$app->post('/validate', function (Request $request, Response $response, $args) {
    $reqBody = json_decode($request->getBody(), true);
    if(Auth::validateToken($reqBody['token'])){
        $message = "Token válido!";
        $status = 200;
    }
    else {
        $message = "Token inválido!";
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('message' => $message, 'status' => $status)));
    return $response;
});

$app->run();
