<?php

namespace App\Repositories\User;

interface IUsers
{
    function validation($request);
    function create(array $data);
    function login($request);
    function show();
    function update($request,$id);
    function updatePassword($request);
    function logout();
}
