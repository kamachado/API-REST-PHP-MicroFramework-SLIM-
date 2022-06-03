<?php

namespace App\Services;

use App\Dao\DaoInterface;
use Exception;

class BaseService implements ServiceInterface {
    
    protected DaoInterface $dao;
    
    function __contruct(DaoInterface $dao){
        $this->dao = $dao;
    }
    
    public function getList(){
        return $this->dao->selectAll();
    }

    public function getById($id) {
       return $this->dao->Select($id);
    }

    public function insert(object $data) {
        try{
             $obj = $this->dao->insert($data);
        } catch (Exception $ex) {
            throw new Exception("Não foi possível a inserção no banco de dado");
        }

        return $obj;
        
    }

    public function remove($id) {
      $this->dao->remove($id);
    }

    public function update($id, object $data) {
         $this->dao->update($id, $data);
         return $data;
    }

}