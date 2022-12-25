<?php

namespace App\Repositories\Province;

interface IProvinces
{
    function showProvinces($request);
    function validate($request);
    function create(array $data);
    function delete($id);
    function editStatus($id,$status);
    function edit($id);
    function update($request,$id);
}
