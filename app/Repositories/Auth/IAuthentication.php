<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;

interface IAuthentication
{
    function validateRegistration($request);
    function create(array $data);
    function login($request);
    function show();
    function update($request);
    function updatePassword($request);
    function logout();
}
