<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Shop\IShop;
use Illuminate\Http\Request;

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
        $this->order->addCart($request);
        return back()->with(['success' => 'New brand successfully added.']);
    }

    public function cartList(){
        $values = $this->order->cartList();
        return view('pages.UserAccount.cart',compact('values'));
    }

    public function removeFromCart($id)
    {
        $this->order->removeFromCart($id);
        return back();
    }

    public function checkCoupon(Request $request)
    {
        $data = $this->order->checkCoupon($request);
        $status = $data[0];
        $discount = $data[1];
        return response()->json(['status' => $status,'discount'=>$discount]);
    }
}
