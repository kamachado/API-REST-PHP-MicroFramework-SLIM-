<?php

namespace App\Dao;

interface DaoInterface {

    function Select($id);

    function selectAll();

    function insert(object $data);

    function update($id, object $data);

    function remove($id);
}
