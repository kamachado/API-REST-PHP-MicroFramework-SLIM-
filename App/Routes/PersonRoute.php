<?php


namespace App\Routes;

use App\Controller\PersonController;
use Slim\App;
class PersonRoute extends BaseRoutes {

    public function __construct() {
        parent::__construct('person', PersonController::class);
    }    
    
    public function route(App $router) {
        parent::route($router);
        $controller = $this->controller;
        $router->get("/person/{id:[0-9]+}/photo[/]", array($controller, 'getPhoto'));
        $router->post("/person/{id:[0-9]+}/photo[/]", array($controller, 'postPhoto'));
        $router->delete("/person/{id:[0-9]+}/photo[/]", array($controller, 'deletePhoto'));
    }
    

}