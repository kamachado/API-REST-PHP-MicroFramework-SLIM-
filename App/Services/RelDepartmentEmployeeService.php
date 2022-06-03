<?php


namespace App\Services;

use Exception;
use App\Dao\RelDepartmentEmployeeDao;

class RelDepartmentEmployeeService extends BaseService {
    
     protected RelDepartmentEmployeeDao $relDepartmentEmployeeDao;

    public function __construct() {
        $this->relDepartmentEmployeeDao = new RelDepartmentEmployeeDao ();
        parent::__contruct($this->relDepartmentEmployeeDao);
    }
    
    public function getByDepartmentId($id){
        return $this->relDepartmentEmployeeDao->SelectEmployees($id);
    }
     
    public function getByEmployeeId($id){
        return $this->relDepartmentEmployeeDao->SelectDepartment($id);
     }
}