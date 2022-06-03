<?php

namespace App\Routes;

use App\Controller\ControllerInterface;
use Slim\App;

abstract class BaseRoutes implements RouteInterface  {

    private string $name;
    protected ControllerInterface $controller;

    public function __construct(string $name, string $controllerClass) {
        $this->name = $name;
        $this->controller = new $controllerClass;
    }

    public function route(App $router) {
        $controller = $this->controller;
        $router->get("/" . $this->name . "[/]", array($controller, 'get'));
        $router->get("/" . $this->name . "/{id:[0-9]+}[/]", array($controller, 'get'));
        $router->put("/" . $this->name . "/{id:[0-9]+}[/]", array($controller, 'put'));
        $router->delete("/" . $this->name . "/{id:[0-9]+}[/]", array($controller, 'delete'));
        $router->post("/" . $this->name . "[/]", array($controller, 'post'));
    }

}
