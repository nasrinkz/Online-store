<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Repositories\Shop\IShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private IShop $order;

    public function __construct(IShop $order)
    {
        $this->order = $order;
    }

    public function addWish($productId)
    {
        $this->order->addWish($productId);
        return $productId;
    }

    public function removeWish($productId)
    {
        $this->order->removeWish($productId);
        return $productId;
    }

    public function removeWishFromList($productId)
    {
        $this->order->removeWish($productId);
        return back();
    }

    public function wishList()
    {
        $values = $this->order->wishList();
        return view('pages.UserAccount.wishlist',compact('values'));
    }

    public function addCart(Request $request){
        $request->validate([
            'size_id' => 'required',
            'color_id' => 'required',
            'number' => 'required',
        ]);
        $data = $request->all();
        $row = new Cart();
        $row->size_id = $data['size_id'];
        $row->color_id = $data['color_id'];
        $row->number = $data['number'];
        $row->product_id = $data['product_id'];
        $row->userIP = $data['userIP'];
        if (Auth::check()){
            $row->user_id = auth()->user()->id;
        }else
        $row->save();
        return back()->with(['success' => 'New brand successfully added.']);
    }
}
