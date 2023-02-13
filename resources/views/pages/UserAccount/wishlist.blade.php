@extends('layouts.master')
@section('title','NikaStore | Wishlist')
@section('breadcrumb')
    @parent
@section('breadcrumbAppend')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
        </ol>
    </nav>
    <h5>Wishlist</h5>
@endsection
@endsection
@section('content')
    <!-- Wishlist Area Start -->
    <section class="wishlist-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Dashboard-Nav  Start-->
                    <div class="dashboard-nav">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="{{route('UserDashboard')}}">Account
                                    settings</a></li>
                            <li class="list-inline-item"><a href="deliver-info.blade.php">Deliver information</a></li>
                            <li class="list-inline-item"><a href="{{route('wishList')}}" class="active">My wishlist</a></li>
                            <li class="list-inline-item"><a href="{{route('cartList')}}">My cart</a></li>
                            <li class="list-inline-item"><a href="order.blade.php">Order</a></li>
                            <li class="list-inline-item"><a href="{{route('logout')}}" class="mr-0">Log-out</a></li>
                        </ul>
                    </div>
                    <!-- Dashboard-Nav  End-->
                </div>
            </div>
            <div class="rows">
                <!-- Wishlist Item Start -->
                <div class="cart-items wishList">
                    <div class="header">
                        <div class="image">
                            Image
                        </div>
                        <div class="info">
                            Name
                        </div>
                        <div class="name">
                            Description
                        </div>
                        <div class="price">
                            Prices
                        </div>
                        <div class="name">
                            Operation
                        </div>
                    </div>
                    <div class="body">
                        @foreach($values as $value)
                            @if($value->product->status == 1)
                            <div class="item">
                            <div class="image">
                                <a href="{{route('ProductDetails',$value->product_id)}}"><img src="{{asset($value->product->cover)}}"></a>
                            </div>
                            <div class="info">
                                <div class="name-text">
                                    <p> {{$value->product->title}}</p>
                                </div>
                            </div>
                                <div class="name">
                                    <p>{!! \Illuminate\Support\Str::limit($value->product->shortDescription, 400), '...' !!}</p>
                                </div>
                            <div class="price">
                                @if($value->product->sellingPrice == $value->product->originalPrice)
                                    <span>{{'$'.$value->product->sellingPrice}}</span>
                                @else
                                    <span>{{'$'.$value->product->sellingPrice}}</span> <del>{{'$'.$value->product->originalPrice}}</del>
                                @endif
                            </div>
                                <div class="name">
                                    <div class="button">
                                        <a class="del text-danger" href="{{route('removeWishFromList',$value->product_id)}}">Remove</a>
                                    </div>
                                </div>
                        </div>
                            @endif
                        @endforeach
                    </div>
                    {{$values->links('vendor.pagination.custom')}}
                </div>
                <!-- Wishlist Item End -->
            </div>
        </div>
    </section>
    <!-- Wishlist Area End -->
@endsection


