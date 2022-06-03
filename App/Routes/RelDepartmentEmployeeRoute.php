<?php

namespace App\Routes;

use App\Controller\RelDepartmentEmployeeController;
use Slim\App;

class RelDepartmentEmployeeRoute extends BaseRoutes {

    public function __construct() {
        parent::__construct('DepartmentEmployee', RelDepartmentEmployeeController::class);
    }

    public function route(App $router) {
        #$log_file = "./my-errors.log";
        #ini_set('display_errors', 1); 
        #ini_set('display_startup_errors', 1); 
        #ini_set('error_reporting', E_ALL);
        #ini_set('error_log', $log_file);
        
        parent::route($router);
        $controller = $this->controller;
        $router->get("/DepartmentEmployee/{id:[0-9]+}/employees[/]", array($controller, 'getEmployees') );
        $router->get("/DepartmentEmployee/{id:[0-9]+}/department[/]", array($controller, 'getDepartment') );
    }

}
