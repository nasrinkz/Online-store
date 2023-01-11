<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Coupon\ICoupons;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    private ICoupons $coupons;

    public function __construct(ICoupons $coupons)
    {
        $this->coupons = $coupons;
    }

    public function index(Request $request)
    {
        $data = $this->coupons->showCoupons($request);
        $values = $data[0];
        $dataTableInfo = $data[1];
        if($request->ajax()){
            return view('admin.pages.coupons.getCouponsData', compact('values','dataTableInfo'));
        }
        return view('admin.pages.coupons.coupons', compact('values','dataTableInfo'));
    }

    public function store(Request $request)
    {
        $this->coupons->validate($request);
        return back()->with(['success' => 'New coupon successfully added.']);
    }

    public function destroy($id)
    {
        $this->coupons->delete($id);
        return back()->with(['delete' => 'Selected coupon successfully deleted.']);
    }

    public function editStatus($id, $status)
    {
        $this->coupons->editStatus($id, $status);
        return $id;
    }

    public function edit($id)
    {
        $value = $this->coupons->edit($id);
        return view('admin.pages.coupons.editCoupon', compact('value'));
    }

    public function update(Request $request, $id)
    {
        $status = $this->coupons->update($request, $id);
        return ($status == 1) ? back()->withSuccess('Coupon details successfully updated.') : back()->withAlert('Nothing changed!');
    }
}
