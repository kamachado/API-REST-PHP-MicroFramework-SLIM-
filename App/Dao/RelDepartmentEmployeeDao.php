<?php

namespace App\Dao;

use App\Models\RelDepartmentEmployee;
use Exception;
use PDO;
class RelDepartmentEmployeeDao extends BaseDao {
    
    
    public function getColumnNames() {
        return [
            "Id_department",
            "Person_Employee_Id"
            
        ];

    }

    public function getModelClassName() {
        return RelDepartmentEmployee::class;
        
    }


    public function getTableName() {
        return "rel_Employee_department";
        
    }

    public function getPrimaryKey() {
        return "Person_Employee_Id";
    }
    
     public function SelectDepartment($id) {

        $sql = ' SELECT PERS.NAME EMPLOYEE, DEP.NAME DEPARTMENT  FROM  PERSON   PERS	JOIN REL_EMPLOYEE_DEPARTMENT   REL ON PERS.ID = REL.PERSON_EMPLOYEE_ID
        JOIN DEPARTMENT  DEP ON DEP.ID = REL.ID_DEPARTMENT  WHERE  ' . $this->getPrimaryKey() . ' = :id';

        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $execute = $stmt->execute();

        if (!$execute) {
            throw new Exception("Não foi possível executar a consulta no banco de dados", 500);
        }
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $item = $stmt->fetchAll();
        if ($item) {
            return $item;
        }else{
            throw new Exception("Nenhum item encontrado", 404);
        }
    }
    
    
     public function SelectEmployees($id) {
        $sql = ' SELECT PERS.NAME EMPLOYEE, DEP.NAME DEPARTMENT  FROM  PERSON   PERS	JOIN REL_EMPLOYEE_DEPARTMENT   REL ON PERS.ID = REL.PERSON_EMPLOYEE_ID
        JOIN DEPARTMENT  DEP ON DEP.ID = REL.ID_DEPARTMENT  WHERE REL.ID_DEPARTMENT  = :id';

        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $execute = $stmt->execute();
        if (!$execute) {
            throw new Exception("Não foi possível executar a consulta no banco de dados", 500);
        }
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $item = $stmt->fetchAll();

        if ($item) {
            return $item;
        } else {
            throw new Exception("Nenhum item encontrado", 404);
        }
    }
    
    
    
   

}

