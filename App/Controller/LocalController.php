<?php

namespace App\Controller;

class LocalController {

    public function get() {
        return "GET";
    }

    public function teste($nome) {
        return ['nome' => $nome];
    }

    public function teste2($nome) {
        return ['teste2' => $nome];
    }

}

