<?php

namespace App\Repositories\Brand;

interface IBrands
{
    function showBrands($request);
    function validate($request);
    function create($data);
    function delete($id);
    function editStatus($id,$status);
    function edit($id);
    function update($request,$id);
}
