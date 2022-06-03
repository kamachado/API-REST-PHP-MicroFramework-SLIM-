<?php

namespace App\Dao;

use App\Models\Person;
use Exception;
use PDO;

Class PersonDao extends BaseDao implements personDaoInterface {

    public function getColumnNames(): array {
        return [
            "Name",
            "CPF",
            "Birth_Date",
            "Dad_Id",
            "Mom_Id",
            "is_employee"
        ];
    }

    public function getModelClassName() {
        return Person::class;
    }

    public function getTableName() {
        return "person";
    }

    public function getPrimaryKey() {
        return "id";
    }

    public function usedCPF(string $cpf, $id = null): bool {
        $sql = 'SELECT COUNT(*) FROM ' . $this->getTableName() . ' WHERE CPF = :CPF';

        if ($id) {
            $sql .= ' AND ' . $this->getPrimaryKey() . ' <> :id';
            $stmt = $this->getConn()->prepare($sql);
            $stmt->bindValue(":id", $id);
        } else {
            $stmt = $this->getConn()->prepare($sql);
        }
        $stmt->bindValue(':CPF', $cpf);
        $execute = $stmt->execute();


        if (!$execute) {
            throw new Exception("Não foi possível executar a consulta no banco de dados", 500);
        }

        $result = $stmt->fetchColumn();

        if ($result !== false) {
            return intval($result) > 0;
        } else {
            return false;
        }
    }

    public function selectIdParent($id) {
        $sql = "SELECT COUNT(*) FROM " . $this->getTableName() . " WHERE " . $id . " IN (SELECT DAD_ID From " . $this->getTableName() .
                " ) or " . $id . " IN (SELECT MOM_ID FROM " . $this->getTableName() . " )";

        $stmt = $this->getConn()->prepare($sql);

        $execute = $stmt->execute();

        if (!$execute) {
            throw new Exception("Não foi possível executar a consulta no banco de dados", 500);
        }

        $result = $stmt->fetchColumn();
        if ($result !== false) {
            return intval($result) > 0;
        } else {
            return false;
        }
    }

    public function selectPersonResponsible($id) {
        $sql = "SELECT * FROM DEPARTMENT WHERE PERSON_RESPONSIBLE_ID = :id";
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $execute = $stmt->execute();

        if (!$execute) {
            throw new Exception("Não foi possível executar a consulta no banco de dados", 500);
        }

        $result = $stmt->fetchColumn();

        if ($result !== false) {
            return intval($result) > 0;
        } else {
            return false;
        }
    }

    public function savePhoto($id, string $mimeType, $data) {
        $sql= 'UPDATE '.$this->getTableName().' SET Photo = :photo WHERE ' .$this->getPrimaryKey().' = :id';
        $pdo = $this->getConn();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':photo', $data, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);

        $execute = $stmt->execute();
        if (!$execute) {
            throw new Exception("Não foi possível executar a consulta no banco de dados", 500);
        }
    }


     public function selectPhoto($id) {
         $sql = 'SELECT Photo FROM ' . $this->getTableName() . ' WHERE ' . $this->getPrimaryKey() . ' = :id';
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindColumn('photo', $photo, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
        $execute = $stmt->execute();

        if (!$execute) {
            throw new Exception(self::EXCEPTION_EXECUTE_DATABASE, 500);
        }
        
        $stmt->setFetchMode(PDO::FETCH_CLASS , $this->getModelClassName());
        return $stmt->fetch();
    }
    
    
    
         public function selectAll() {

        $sql = 'SELECT Id,  Name,
            CPF,
            Birth_Date,
            Dad_Id,
            Mom_Id,
            is_employee  FROM ' . $this->getTableName();
        $stmt = $this->getConn()->prepare($sql);
        $stmt->execute();
         $stmt->setFetchMode(PDO::FETCH_OBJ);
       $result = $stmt->fetchAll();
        return $result;
    }

    
    
     public function Select($id) {
        $sql = ' SELECT  Name,
            CPF,
            Birth_Date,
            Dad_Id,
            Mom_Id,
            is_employee  FROM ' . $this->getTableName() . ' WHERE ' . $this->getPrimaryKey() . ' = :id';
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $execute = $stmt->execute();

        if (!$execute) {
            throw new Exception("Não foi possível executar a consulta no banco de dados", 500);
        }
          $stmt->setFetchMode(PDO::FETCH_OBJ);
       $result = $stmt->fetch();
        return $result;

        if ($item) {
            return $item;
        } else {
            throw new Exception("Nenhum item encontrado", 404);
        }
    }

        
        
   

}
