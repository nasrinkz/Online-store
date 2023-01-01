<?php

namespace App\Repositories\ContactUs;

interface IContactUs
{
    function showMessages($request);
    function details($id);
    function validate($request);
    function store($request);
}
