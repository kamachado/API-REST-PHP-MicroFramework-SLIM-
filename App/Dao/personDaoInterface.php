<?php

namespace App\Dao;


interface personDaoInterface {
    public function selectPhoto($id);
    
    public function savePhoto($id, string $mimeType, $data);
}
