<?php

namespace App\Services;

interface ServiceInterface {

    function getById($id);

    function getList();

    function remove($id);

    function update($id, object $data);

    function insert(object $data);
}
