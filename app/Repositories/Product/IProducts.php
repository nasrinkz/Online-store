<?php

namespace App\Repositories\Product;

interface IProducts
{
    function showProducts($request);
    function validate($request);
    function create(array $data);
    function delete($id);
    function editStatus($id,$status);
    function edit($id);
    function update($request,$id);
}
