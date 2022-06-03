<?php

require '../vendor/autoload.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);

$app = new \Slim\App($c);



$routes = [
    new App\Routes\PersonRoute(),
    new App\Routes\DepartmentRoute(),
    new App\Routes\RelDepartmentEmployeeRoute()
];

try {

    $app->add(new \App\Middlewares\ErrorHandlerMiddleware());
    //$app->add(new \App\Middlewares\Cors());
    $app->add(new Tuupola\Middleware\CorsMiddleware);

    
    
    foreach ($routes as $route) {
        $route->route($app);
    }

    $app->run();
} catch (Exception $e) {
    $code = $e->getCode();
    http_response_code($code > 0 ? $code : 500);
    echo json_encode(array('status' => 'error', 'data' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
    exit;
}


