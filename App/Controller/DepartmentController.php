<?php


namespace App\Controller;

use App\Models\Department;
use App\Services\DepartmentService;

class DepartmentController extends BaseController {
    
     public function __construct() {
        parent::__construct(new DepartmentService());
    }
    
    
    
    protected function getModelClassName(): string {
        return Department::class;
    }

}
