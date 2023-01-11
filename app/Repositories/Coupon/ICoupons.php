<?php

namespace App\Repositories\Coupon;

interface ICoupons
{
    function showCoupons($request);
    function validate($request);
    function create(array $data);
    function delete($id);
    function editStatus($id,$status);
    function edit($id);
    function update($request,$id);
}
