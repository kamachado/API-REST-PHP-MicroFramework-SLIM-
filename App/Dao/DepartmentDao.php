<?php


namespace App\Dao;

use App\Models\Department;
use PDO;
use Exception;

class DepartmentDao extends BaseDao{
    
 
    public function getColumnNames() {
        return [
            "Name",
            "Person_Responsible_Id"
        ];
        
    }

    public function getModelClassName() {
        return Department::class;
        
    }

    public function getPrimaryKey() {
        return "id";
        
    }

    public function getTableName() {
        return "department";
    }


}
