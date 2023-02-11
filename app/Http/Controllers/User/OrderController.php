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
}
