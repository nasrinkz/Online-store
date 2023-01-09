<?php

namespace App\Repositories\Color;

interface IColors
{
    function showColors($request);
    function validate($request);
    function create($data);
    function delete($id);
    function editStatus($id,$status);
    function edit($id);
    function update($request,$id);
}
