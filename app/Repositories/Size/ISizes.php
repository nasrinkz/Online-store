<?php

namespace App\Repositories\Size;

interface ISizes
{
    function showSizes($request);
    function validate($request);
    function create($data);
    function delete($id);
    function editStatus($id,$status);
    function edit($id);
    function update($request,$id);
}
