<?php

namespace App\Repositories\User;

interface IUsers
{
    function validation($request);
    function create(array $data);
}
