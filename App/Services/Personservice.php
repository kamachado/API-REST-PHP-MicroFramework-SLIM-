<?php

namespace App\Services;

use DateTime;
use Exception;
use App\Dao\personDaoInterface;
use App\Dao\PersonDao;
use App\Models\Person;

use Psr\Http\Message\UploadedFileInterface;

Class PersonService extends BaseService implements PersonServiceInterface {

    protected PersonDao $personDao;

    public function __construct() {
        $this->personDao = new PersonDao();
        parent::__contruct($this->personDao);
    }

    public function insert(object $data) {
        $this->validBirthDate($data);
        $this->validCPF($data);
        try {
            $obj = parent::insert($data);
        } catch (Exception $ex) {

            throw new Exception("Não foi possível a inserção no banco de dado", 400);
        }

        return $obj;
    }

    public function update($id, object $data) {
             return parent::update($id, $data);
    }
    
    public function remove($id) {
        $parent = $this->personDao->selectIdParent($id);
        if ($parent ){
            throw new Exception("Pessoa possui filho cadastrado", 400);
        }
        $personResponsible= $this->personDao->selectPersonResponsible($id);
        if ($personResponsible ){
            throw new Exception("Pessoa é responsável por um departamento", 400);
        }
        parent::remove($id);
        return ("Person_ID : $id deletado com sucesso");
    }

    public function validBirthDate(Person $person) {

        if (!$person->Birth_Date) {
            throw new Exception("Data de nascimento inválida.", 400);
        }

        $now = new DateTime();


        $d = false;

        try {
            $d = new DateTime($person->Birth_Date);
        } catch (Exception $e) {
            
        }

        if (!$d) {
            throw new Exception("Data de nascimento inválida. Caiu no !d", 400);
        }

        $diff = $now->diff($d);
        if (!$diff) {
            throw new Exception("Data de nascimento inválida", 400);
        }

        if ($diff->invert === 0) {
            throw new Exception("Data de nascimento deve ser menor que agora", 400);
        }
    }

    public function validCPF(Person $person) {
        if ($person->CPF) {
            $exist = $this->personDao->usedCPF($person->CPF, $person->Id);

            if ($exist) {
                throw new Exception("CPF já está em uso", 400);
            }

            $position = 0;

            for ($i = 0; $i < (strlen($person->CPF)); $i++) {

                if (is_numeric($person->CPF[$i])) {

                    $digit[$position] = $person->CPF[$i];

                    $position++;
                }
            }

            if (count($digit) !== 11) {
                throw new Exception("CPF iválido", 404);
            } else {
                for ($i = 0; $i < 10; $i++) {
                    if ($digit[0] == $i && $digit[1] == $i 
                            && $digit[2] == $i && $digit[3] == $i 
                            && $digit[4] == $i && $digit[5] == $i 
                            && $digit[6] == $i && $digit[7] == $i
                            && $digit[8] == $i) {

                        throw new Exception("CPF inválido", 404);
                    }
                }
            }

            $multiplier = 10;
            for ($i = 0; $i < 9; $i++) {
                $multiplication[$i] = $digit[$i] * $multiplier;

                $multiplier--;
            }
            $sum = array_sum($multiplication);
            $rest = $sum % 11;
            if ($rest < 2) {
                $newDigit = 0;
            } else {
                $newDigit = 11 - $rest;
            }
            if ($newDigit != $digit[9]) {
                throw new Exception("CPF inválido", 404);
            }

            $multiplier2 = 11;
            for ($i = 0; $i < 10; $i++) {
                $multiplication[$i] = $digit[$i] * $multiplier2;
                $multiplier2--;
            }
            $sum = array_sum($multiplication);
            $rest = $sum % 11;
            if ($rest < 2) {
                $newDigit2 = 0;
            } else {
                $newDigit2 = 11 - $rest;
            }
            if ($newDigit2 != $digit[10]) {
                throw new Exception("CPF inválido", 404);
            }
            return true;
        } else {
            return true;
        }
    }

    public function getPhoto($id):Person{
        return $this->personDao->selectPhoto($id);
        
    }

    public function savePhoto($id, string $mimeType, $data) {
        $this->personDao->savePhoto($id, $mimeType, $data);
    }

}
