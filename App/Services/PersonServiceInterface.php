<?php
namespace App\Services;

use App\Models\Person;
use Psr\Http\Message\UploadedFileInterface;


interface PersonServiceInterface extends ServiceInterface {
    
    public function validBirthDate(Person $person);


    Public function validCPF(Person $person);
    
    public function savePhoto($id, string $MimeType, $data);
    
    public function getPhoto($id):Person;
}

