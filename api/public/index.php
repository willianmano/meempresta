<?php

use Silex\Application;
use ME\Service\ModelServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

define("APP_ROOT", dirname(__DIR__));

chdir(APP_ROOT);

require "vendor/autoload.php";

$app = new Application();

$app->register(new DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_mysql',
        'dbname' => 'meempresta',
        'host' => 'localhost',
        'user' => 'root',
        'password' => null,
    )
));

$app->register(new ModelServiceProvider());

$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')
        || 0 === strpos($request->headers->get('Content-Type'), 'application/x-www-form-urlencoded'))
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

$app->after(function (Request $req, Response $resp, Application $app) {
    $resp->headers->set('Access-Control-Allow-Origin', '*');
    $resp->headers->set('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept, Authorization');
});

//ROTAS
$app->get('/', function () {
    return 'Hello World!';
});

$app->get('/v1/emprestimos', function () use ($app) {
    $emprestimos = $app['model.emprestimo']->getAllEmprestimos();

    return new JsonResponse($emprestimos, 200);
});

$app->post('/v1/emprestimos/baixa', function (Request $request) use ($app) {
    $id = $request->request->get('id');
    $status = "aberto";

    if ($request->request->get('status')) {
        $status = "devolvido";
    }

    try {
        $app['model.emprestimo']->mudarStatus($id, $status);

        return new JsonResponse(['id' => $id, 'status' => $status], 200);
    } catch(\Exception $e) {
        return new JsonResponse(['msg' => 'Ocorreu um erro ao tentar processar essa requisição'], 500);
    }
});

$app->run();