<?php

namespace App\Services;

use App\Dao\DepartmentDao;

class DepartmentService extends BaseService{
    
    protected DepartmentDao $departmentDao;
    
    public function __construct() {
        $this->departmentDao = new DepartmentDao();
        parent::__contruct($this->departmentDao);
    }
    
    public function remove($id) {
        parent::remove($id);
        return ("Department_ID : $id deletado com sucesso");
    }

}
