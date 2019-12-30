<?php 

header("Content-type: application/json");

use Slim\Psr7\Response as ResponseModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$customErrorHandler = function () use ($app) {
    $response = $app->getResponseFactory()->createResponse();
    $response->getBody()->write('404 - not found');
    return $response->withStatus(404);
};

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setErrorHandler(Slim\Exception\HttpNotFoundException::class, $customErrorHandler);

$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://localhost:8080')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->addBodyParsingMiddleware();

$authorizationMiddleware = function (Request $request, RequestHandler $handler) {
    $response = $handler->handle($request);
    $authorization = $request->getHeader('Authorization')[0];
    if(!Auth::validateToken($authorization)) {
        $response = new ResponseModel();
        $response->getBody()->write(
            json_encode(
                array(
                    'message' => 'Acesse negado!',
                    'status' => 401
                )
            )
        );
        return $response->withStatus(401);
    }
    return $response;
};

$adminMiddleware = function (Request $request, RequestHandler $handler) {
    $response = $handler->handle($request);
    $authorization = $request->getHeader('Authorization')[0];
    if(Auth::validateToken($authorization) and !Auth::isAdmin($authorization)) {
        $response = new ResponseModel();
        $response->getBody()->write(
            json_encode(
                array(
                    'message' => 'É preciso ser administrador para executar esta ação!',
                    'status' => 401
                )
            )
        );
        return $response->withStatus(401);
    }
    return $response;
};

$app->get('/users', function (Request $request, Response $response, $args) {
    try {
        $data = UserController::getAll();
        $message = 'Recuperação de registros efetuada com sucesso!';
        $status = 200;
    }
    catch(Exception $e) {
        $data = [];
        $message = $e->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('data' => $data, 'message' => $message, 'status' => $status)));
    return $response->withStatus($status);
})->add($authorizationMiddleware)->add($adminMiddleware);

$app->get('/users/{id}', function (Request $request, Response $response, $args) {
    try {
        $data = UserController::get($args['id']);
        $message = 'Recuperação de registro efetuada com sucesso!';
        $status = 200;
    }
    catch(Exception $e) {
        $data = [];
        $message = $e->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('data' => $data, 'message' => $message, 'status' => $status)));
    return $response->withStatus($status);
})->add($authorizationMiddleware);

$app->delete('/users/{id}', function (Request $request, Response $response, $args) {
    try {
        UserController::delete($args['id']);
        $message = 'Registro deletado com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $message = $ex->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('message' => $message, 'status' => $status)));
    return $response->withStatus($status);
})->add($authorizationMiddleware)->add($adminMiddleware);

$app->put('/users/{id}', function (Request $request, Response $response, $args) {
    try {
        UserController::update($args['id'], json_decode($request->getBody(), true));
        $data = UserController::get($args['id']);
        $message = 'Registro alterado com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $data = [];
        $message = $ex->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('data' => $data, 'message' => $message, 'status' => $status)));
    return $response->withStatus($status);
})->add($authorizationMiddleware)->add($adminMiddleware);

$app->post('/users', function (Request $request, Response $response, $args) {
    try {
        $data = $request->getBody();
        UserController::signup(json_decode($request->getBody(), true));
        $message = 'Usuário registrado com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $data = [];
        $message = $ex->getMessage();
        $status = 500;
    }
    $response->getBody()->write(json_encode(array('data' => $data, 'message' => $message, 'status' => $status)));
    return $response->withStatus($status, $message);
});

$app->get('/categories', function (Request $request, Response $response, $args) {
    try {
        $data = CategoryController::getAll();
        $message = 'Recuperação de registros efetuada com sucesso!';
        $status = 200;
    }
    catch(Exception $e) {
        $data = [];
        $message = $e->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('data' => $data, 'message' => $message, 'status' => $status)));
    return $response->withStatus($status);
})->add($authorizationMiddleware)->add($adminMiddleware);


$app->get('/categories/tree', function (Request $request, Response $response, $args) {
    try {
        $data = CategoryController::getTree();
        $message = 'Recuperação de registros efetuada com sucesso!';
        $status = 200;
    }
    catch(Exception $e) {
        $data = [];
        $message = $e->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('data' => $data, 'message' => $message, 'status' => $status)));
    return $response->withStatus($status);
});


$app->get('/categories/{id}', function (Request $request, Response $response, $args) {
    try {
        $data = CategoryController::get($args['id']);
        $message = 'Recuperação de registro efetuada com sucesso!';
        $status = 200;
    }
    catch(Exception $e) {
        $data = [];
        $message = $e->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('data' => $data, 'message' => $message, 'status' => $status)));
    return $response->withStatus($status);
})->add($authorizationMiddleware);

$app->post('/categories', function (Request $request, Response $response, $args) {
    try {
        CategoryController::insert(json_decode($request->getBody(), true));
        $data = $request->getBody();
        $message = 'Registro inserido com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $data = [];
        $message = $ex->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('data' => $data, 'message' => $message, 'status' => $status)));
    return $response->withStatus($status);
})->add($authorizationMiddleware)->add($adminMiddleware);

$app->delete('/categories/{id}', function (Request $request, Response $response, $args) {
    try {
        CategoryController::delete($args['id']);
        $message = 'Registro deletado com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $message = "Erro ao excluir: Foreign key";
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('message' => $message, 'status' => $status)));
    return $response->withStatus($status);
})->add($authorizationMiddleware)->add($adminMiddleware);

$app->put('/categories/{id}', function (Request $request, Response $response, $args) {
    try {
        CategoryController::update($args['id'], json_decode($request->getBody(), true));
        $data = CategoryController::get($args['id']);
        $message = 'Registro alterado com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $data = [];
        $message = $ex->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('data' => $data, 'message' => $message, 'status' => $status)));
    return $response->withStatus($status);
})->add($authorizationMiddleware)->add($adminMiddleware);


$app->get('/articles', function (Request $request, Response $response, $args) {
    try {
        $page = $_GET['page'] ?? 1;
        $data = array(
            'articles' => ArticleController::getAllWithPagination($page),
            'limit' => ArticleDAO::limit,
            'count' => ArticleController::count()
        );
        $status = 200;
        $message = 'Registros recuperados com sucesso!';
    }
    catch(Exception $e) {
        $data = [];
        $message = $e->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('data' => $data, 'message' => $message, 'status' => $status)));
    return $response->withStatus($status);
})->add($authorizationMiddleware)->add($adminMiddleware);

$app->get('/articles/{id}', function (Request $request, Response $response, $args) {
    try {
        $data = ArticleController::get($args['id']);
        $message = 'Recuperação de registro efetuada com sucesso!';
        $status = 200;
    }
    catch(Exception $e) {
        $data = [];
        $message = $e->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('data' => $data, 'message' => $message, 'status' => $status)));
    return $response->withStatus($status);
})->add($authorizationMiddleware);

$app->delete('/articles/{id}', function (Request $request, Response $response, $args) {
    try {
        ArticleController::delete($args['id']);
        $message = 'Registro deletado com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $message = $ex->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('message' => $message, 'status' => $status)));
    return $response->withStatus($status);
})->add($authorizationMiddleware)->add($adminMiddleware);

$app->post('/articles', function (Request $request, Response $response, $args) {
    try {
        ArticleController::insert(json_decode($request->getBody(), true));
        $data = $request->getBody();
        $message = 'Registro inserido com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $data = [];
        $message = $ex->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('data' => $data, 'message' => $message, 'status' => $status)));
    return $response->withStatus($status);
})->add($authorizationMiddleware)->add($adminMiddleware);;

$app->put('/articles/{id}', function (Request $request, Response $response, $args) {
    try {
        ArticleController::update($args['id'], json_decode($request->getBody(), true));
        $data = ArticleController::get($args['id']);
        $message = 'Registro alterado com sucesso!';
        $status = 200;
    }
    catch(Exception $ex) {
        $data = [];
        $message = $ex->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('data' => $data, 'message' => $message, 'status' => $status)));
    return $response->withStatus($status);
})->add($authorizationMiddleware)->add($adminMiddleware);

$app->get('/categories/{category}/articles', function (Request $request, Response $response, $args) {
    try {
        $data = ArticleController::getByCategory((int)$args['category'], $_GET['page']);
        $message = 'Recuperação de registros efetuada com sucesso!';
        $status = 200;
    }
    catch(Exception $e) {
        $data = [];
        $message = $e->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('data' => $data, 'message' => $message, 'status' => $status)));
    return $response->withStatus($status);
})->add($authorizationMiddleware);

$app->get('/stats', function (Request $request, Response $response, $args) {
    try {
        $data = Controller::stats();
        $message = 'Recuperação de registros efetuada com sucesso!';
        $status = 200;
    }
    catch(Exception $e) {
        $data = [];
        $message = $e->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('data' => $data, 'message' => $message, 'status' => $status)));
    return $response->withStatus($status);
})->add($authorizationMiddleware);

$app->post('/signin', function (Request $request, Response $response, $args) {
    $reqBody = json_decode($request->getBody(), true);
    try {
        $token = UserController::signin($reqBody['email'], $reqBody['password']);
        $user = UserController::getByEmail($reqBody['email']);
        $data = array(
            'user' => $user,
            'token' => $token
        );
        $message = "Login efetuado com sucesso!";
        $status = 200;
    }
    catch(Exception $e) {
        $data = [];
        $message = $e->getMessage();
        $status = 400;
    }
    $response->getBody()->write(json_encode(array('data' => $data, 'message' => $message, 'status' => $status)));
    return $response->withStatus($status);
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
    return $response->withStatus($status);
});

$app->run();
