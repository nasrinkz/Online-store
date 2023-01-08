<?php

namespace App\Repositories\Category;

interface ICategories
{
    function showCategories($request);
    function validate($request);
    function create($data);
    function delete($id);
    function editStatus($id,$status);
    function edit($id);
    function update($request,$id);
}
