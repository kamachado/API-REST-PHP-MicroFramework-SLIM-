<?php

namespace App\Dao;

use Exception;
use PDO;

Abstract class BaseDao implements DaoInterface {

    private $conn;

    function __construct() {
        $this->conn = self::getConnPDO();
    }

    private static function getConnPDO() {
        return new PDO(DBDRIVE . ': server=' . DBHOST . '; Database=' . DBNAME, DBUSER, DBPASS);
    }

    public function getConn(): PDO {
        return $this->conn;
    }
    
    private function getSelectColumns() {
        $columns = $this->getColumnNames();
        array_push($columns, $this->getPrimaryKey());
        return $columns;
    }


    public function selectAll() {
        $selectColumns = $this->getSelectColumns();
        $sql = 'SELECT ' . implode(',', $selectColumns) . ' FROM ' . $this->getTableName();
        $stmt = $this->getConn()->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->getModelClassName());
        $result = $stmt->fetchAll();
        return $result;

    }

    public function select($id) {
        $selectColumns = $this->getSelectColumns();
        $sql = 'SELECT ' . implode(',', $selectColumns) . ' FROM ' . $this->getTableName() . ' WHERE ' . $this->getPrimaryKey() . ' = :id';
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $execute = $stmt->execute();

        if (!$execute) {
            throw new Exception(self::EXCEPTION_EXECUTE_DATABASE, 500);
        }

        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->getModelClassName());
       
        $item = $stmt->fetch();

        if ($item) {
            return $item;
        } else {
            throw new Exception("Não foi possível executar a consulta no banco de dados", 404);
        }
    }



    public function getNextID() {
        $sql = 'SELECT MAX (' . $this->getPrimaryKey() . ') VALOR_ATUAL FROM ' . $this->getTableName();
        $stmt = $this->getConn()->prepare($sql);
        $execute = $stmt->execute();

        if (!$execute) {
            throw new Exception("Não foi possível executar a consulta no banco de dado", 500);
        }
        $result = $stmt->fetchColumn();

        if (!$result) {
            return 1;
        }
        return intval($result) + 1;
    }

    public function insert(object $data) {
        $values = [];
        $id = $this->getNextId();


        foreach ($this->getColumnNames() as $column) {
            array_push($values, ":$column");
        }

        $sql = 'INSERT INTO ' . $this->getTableName() . ' (' . implode(',', $this->getColumnNames())
                . ') VALUES (' . implode(', ', $values) . ')';

        $stmt = $this->getConn()->prepare($sql);

        foreach ($this->getColumnNames() as $column) {
            if (property_exists($data, $column)) {
                $stmt->bindValue(":$column", $data->{$column});
            }
        }


        $execute = $stmt->execute();


        if (!$execute) {
            die($sql . " | " . json_encode($stmt->errorInfo()));
            throw new Exception("Não foi possível a inserção no banco de dado");
        }

        return $this->Select($id);
    }

   public function update($id, object $data) {
        $values = [];
        foreach ($this->getColumnNames() as $column) {
            array_push($values, "$column = :$column");
        }

        $sql = "UPDATE " . $this->getTableName() . " SET " . implode(', ', $values) . " WHERE " . $this->getPrimaryKey() . " = :id";
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        foreach ($this->getColumnNames() as $column) {
            if (property_exists($data, $column)) {
                $stmt->bindValue(":$column", $data->{$column});
            }
        }
        
    
        $execute = $stmt->execute();
    

        if (!$execute) {
            throw new Exception("Não foi possível executar a consulta no banco de dados", 500);
        }
    }


    
    
    function remove($id) {
        $result = $this->Select($id);
        if($result){
        $sql = 'DELETE FROM ' . $this->getTableName() . ' WHERE ' . $this->getPrimaryKey() . ' = :id';
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $execute = $stmt->execute();
        if (!$execute) {
            throw new Exception("Não foi possível executar a consulta no banco de dados", 500);
        }
        }
    }



    public abstract function getTableName();

    public abstract function getModelClassName();

    public abstract function getColumnNames();

    public abstract function getPrimaryKey();

}
