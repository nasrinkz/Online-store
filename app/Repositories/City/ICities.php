<?php

namespace App\Repositories\City;

interface ICities
{
    function showCities($request);
    function validate($request);
    function create(array $data);
    function delete($id);
    function editStatus($id,$status);
    function edit($id);
    function update($request,$id);
}
