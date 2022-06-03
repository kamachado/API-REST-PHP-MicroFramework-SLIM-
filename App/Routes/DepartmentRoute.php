<?php



namespace App\Routes;

use App\Controller\DepartmentController;

class DepartmentRoute extends BaseRoutes {
    
    public function __construct() {
       parent::__construct('department', DepartmentController::class);
    }
   
}
